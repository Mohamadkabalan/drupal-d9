<?php

namespace Drupal\Tests\url_alias_permissions\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test url_alias_permissions with an entity without bundles.
 *
 * @group url_alias_permissions
 */
class EntityWithoutBundleFormTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'url_alias_permissions_test',
    'entity_test',
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
   * The entity test storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $entityTestStorage;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setup();

    $this->userWithUrlAliasPermissions = $this->drupalCreateUser([
      'administer entity_test content',
      'create url aliases',
      'edit entity_test url alias',
      'view test entity',
    ]);
    $this->userWithoutUrlAliasPermissions = $this->drupalCreateUser([
      'administer entity_test content',
      'view test entity',
    ]);

    $this->entityTestStorage = $this->container->get('entity_type.manager')->getStorage('entity_test');
  }

  /**
   * Test if the path alias form elements is correctly hidden when no access.
   */
  public function testPathAliasFormElementAccess() {
    // Visit the entity_test add page and check that the path field is present.
    $this->drupalLogin($this->userWithUrlAliasPermissions);
    $this->drupalGet('/entity_test/add');
    $this->assertSession()->fieldExists('url_alias[0][alias]');

    // Create an entity_test.
    $name = $this->randomMachineName();
    $this->submitForm([
      'name[0][value]' => $name,
      'url_alias[0][alias]' => '/test-alias',
    ], 'Save');

    // Check that the URL alias was successfully saved.
    $entity = $this->getEntityTestByName($name);
    $this->assertEquals('/test-alias', $entity->get('url_alias')->alias);

    // Visit the entity_test edit page and check that the path field is also
    // present.
    $this->drupalGet('entity_test/manage/' . $entity->id() . '/edit');
    $this->assertSession()->fieldExists('url_alias[0][alias]');

    // Log in as a user that doens't have access to edit the URL alias.
    $this->drupalLogin($this->userWithoutUrlAliasPermissions);

    // Check that the field is not present.
    $this->drupalGet('/entity_test/add');
    $this->assertSession()->fieldNotExists('url_alias[0][alias]');

    // Check that the field on the entity_test edit form is not present.
    $this->drupalGet('entity_test/manage/' . $entity->id() . '/edit');
    $this->assertSession()->fieldNotExists('url_alias[0][alias]');

    // Save the form and check that the URL alias still exists.
    $this->submitForm([], 'Save');
    $entity = $this->getEntityTestByName($name);
    $this->assertEquals('/test-alias', $entity->get('url_alias')->alias);
  }

  /**
   * Get an entity_test by name.
   *
   * @param string $name
   *   The name of the entity_test.
   * @param bool $reset
   *   (optional) Whether to reset the entity cache.
   *
   * @return \Drupal\Core\Entity\EntityInterface|false
   *   The entity_test when found, else FALSE.
   */
  protected function getEntityTestByName(string $name, bool $reset = FALSE) {
    if ($reset === TRUE) {
      $this->entityTestStorage->resetCache();
    }
    $entities = $this->entityTestStorage->loadByProperties(['name' => $name]);
    return current($entities);
  }

}
