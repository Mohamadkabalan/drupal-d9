<?php

namespace Drupal\Tests\url_alias_permissions\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test url_alias_permissions with nodes.
 *
 * @group url_alias_permissions
 */
class NodeFormTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'url_alias_permissions_test',
    'node',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * A user with the permission to edit the URL alias.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $userWithUrlAliasPermissions;

  /**
   * A user without the permission to edit the URL alias.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $userWithoutUrlAliasPermissions;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setup();
    $this->createContentType(
      [
        'type' => 'page',
        'name' => 'Basic page',
        'display_submitted' => FALSE,
      ]);

    $this->userWithUrlAliasPermissions = $this->drupalCreateUser([
      'create page content',
      'edit any page content',
      'create url aliases',
      'edit page node url alias',
    ]);
    $this->userWithoutUrlAliasPermissions = $this->drupalCreateUser([
      'create page content',
      'edit any page content',
    ]);
  }

  /**
   * Test if the path alias form elements is correctly hidden when no access.
   */
  public function testPathAliasFormElementAccess() {
    // Visit a node add page and check that the path field is present.
    $this->drupalLogin($this->userWithUrlAliasPermissions);
    $this->drupalGet('/node/add/page');
    $this->assertSession()->fieldExists('path[0][alias]');

    // Create a node.
    $title = $this->randomMachineName();
    $this->submitForm([
      'title[0][value]' => $title,
      'path[0][alias]' => '/test-alias',
    ], 'Save');

    // Check that the URL alias was successfully saved.
    $node = $this->drupalGetNodeByTitle($title);
    $this->assertEquals('/test-alias', $node->get('path')->alias);

    // Visit the node edit page and check that the path field is also present.
    $this->drupalGet('node/' . $node->id() . '/edit');
    $this->assertSession()->fieldExists('path[0][alias]');

    // Log in as a user that doens't have access to edit the URL alias.
    $this->drupalLogin($this->userWithoutUrlAliasPermissions);

    // Check that the field is not present.
    $this->drupalGet('/node/add/page');
    $this->assertSession()->fieldNotExists('path[0][alias]');

    // Check that the field on the node edit form is not present.
    $this->drupalGet('node/' . $node->id() . '/edit');
    $this->assertSession()->fieldNotExists('path[0][alias]');

    // Save the form and check that the URL alias still exists.
    $this->submitForm([], 'Save');
    $node = $this->drupalGetNodeByTitle($title, TRUE);
    $this->assertEquals('/test-alias', $node->get('path')->alias);
  }

}
