<?php

namespace Drupal\Tests\url_alias_permissions\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\taxonomy\Traits\TaxonomyTestTrait;

/**
 * Test url_alias_permissions with taxonomy terms.
 *
 * @group url_alias_permissions
 */
class TaxonomyTermFormTest extends BrowserTestBase {

  use TaxonomyTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'url_alias_permissions_test',
    'taxonomy',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * A taxonomy vocabulary.
   *
   * @var \Drupal\taxonomy\VocabularyInterface
   */
  protected $vocabulary;

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
   * The taxonomy term storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $taxonomyTermStorage;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setup();
    $this->vocabulary = $this->createVocabulary();

    $this->userWithUrlAliasPermissions = $this->drupalCreateUser([
      'create terms in ' . $this->vocabulary->id(),
      'edit terms in ' . $this->vocabulary->id(),
      'create url aliases',
      'edit ' . $this->vocabulary->id() . ' taxonomy_term url alias',
    ]);
    $this->userWithoutUrlAliasPermissions = $this->drupalCreateUser([
      'create terms in ' . $this->vocabulary->id(),
      'edit terms in ' . $this->vocabulary->id(),
    ]);

    $this->taxonomyTermStorage = $this->container->get('entity_type.manager')->getStorage('taxonomy_term');
  }

  /**
   * Test if the path alias form elements is correctly hidden when no access.
   */
  public function testPathAliasFormElementAccess() {
    // Visit the taxonomy term add page and check that the path field is
    // present.
    $this->drupalLogin($this->userWithUrlAliasPermissions);
    $this->drupalGet('admin/structure/taxonomy/manage/' . $this->vocabulary->id() . '/add');
    $this->assertSession()->fieldExists('path[0][alias]');

    // Create a taxonomy term.
    $name = $this->randomMachineName();
    $this->submitForm([
      'name[0][value]' => $name,
      'path[0][alias]' => '/test-alias',
    ], 'Save');

    // Check that the URL alias was successfully saved.
    $term = $this->getTermByName($name, $this->vocabulary->id());
    $this->assertEquals('/test-alias', $term->get('path')->alias);

    // Visit the taxonomy term edit page and check that the path field is also
    // present.
    $this->drupalGet('taxonomy/term/' . $term->id() . '/edit');
    $this->assertSession()->fieldExists('path[0][alias]');

    // Log in as a user that doens't have access to edit the URL alias.
    $this->drupalLogin($this->userWithoutUrlAliasPermissions);

    // Check that the field is not present.
    $this->drupalGet('admin/structure/taxonomy/manage/' . $this->vocabulary->id() . '/add');
    $this->assertSession()->fieldNotExists('path[0][alias]');

    // Check that the field on the taxonomy term edit form is not present.
    $this->drupalGet('taxonomy/term/' . $term->id() . '/edit');
    $this->assertSession()->fieldNotExists('path[0][alias]');

    // Save the form and check that the URL alias still exists.
    $this->submitForm([], 'Save');
    $term = $this->getTermByName($name, $this->vocabulary->id(), TRUE);
    $this->assertEquals('/test-alias', $term->get('path')->alias);
  }

  /**
   * Find a term by name.
   *
   * @param string $name
   *   The taxonomy term name.
   * @param string $vocabulary_id
   *   The vocabulary ID.
   * @param bool $reset
   *   (optional) Whether to reset the entity cache.
   *
   * @return \Drupal\Core\Entity\EntityInterface|false
   *   The term entity when found, else NULL.
   */
  protected function getTermByName(string $name, string $vocabulary_id, bool $reset = FALSE) {
    if ($reset === TRUE) {
      $this->taxonomyTermStorage->resetCache();
    }
    $terms = $this->taxonomyTermStorage->loadByProperties([
      'name' => trim($name),
      'vid' => $vocabulary_id,
    ]);
    return current($terms);
  }

}
