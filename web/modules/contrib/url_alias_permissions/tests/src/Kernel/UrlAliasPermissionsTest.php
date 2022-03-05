<?php

namespace Drupal\Tests\url_alias_permissions\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\node\Traits\ContentTypeCreationTrait;
use Drupal\Tests\taxonomy\Traits\TaxonomyTestTrait;
use Drupal\url_alias_permissions\UrlAliasPermPermissions;

/**
 * Tests the UrlAliasPermPermissions class.
 *
 * @group url_alias_permissions
 *
 * @coversDefaultClass \Drupal\url_alias_permissions\UrlAliasPermPermissions
 */
class UrlAliasPermissionsTest extends KernelTestBase {

  use ContentTypeCreationTrait;
  use TaxonomyTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'url_alias_permissions',
    'url_alias_permissions_test',
    'node',
    'entity_test',
    'field',
    'text',
    'filter',
    'user',
    'path',
    'taxonomy',
    'system',
  ];

  /**
   * The entity field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManagerInterface
   */
  protected $entityFieldManager;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected $entityTypeBundleInfo;

  /**
   * The node type storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $nodeTypeStorage;

  /**
   * The url alias permissions callback.
   *
   * @var \Drupal\url_alias_permissions\UrlAliasPermPermissions
   */
  protected $urlAliasPermPermissions;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->installEntitySchema('node');
    $this->installEntitySchema('user');
    $this->installEntitySchema('entity_test');
    $this->installSchema('node', 'node_access');
    $this->installConfig('node');
    $this->installConfig('filter');

    $this->entityFieldManager = $this->container->get('entity_field.manager');
    $this->entityTypeBundleInfo = $this->container->get('entity_type.bundle.info');
    $this->entityTypeManager = $this->container->get('entity_type.manager');
    $this->urlAliasPermPermissions = new UrlAliasPermPermissions($this->entityFieldManager, $this->entityTypeBundleInfo, $this->entityTypeManager);
    $this->nodeTypeStorage = $this->entityTypeManager->getStorage('node_type');
  }

  /**
   * Test the permissions created by UrlAliasPermPermissions.
   *
   * @covers ::urlAliasPermissions
   */
  public function testPermissions() {
    $this->createContentType(['type' => 'bar']);
    $this->createContentType(['type' => 'foo']);

    $this->assertEquals([
      // Make sure permissions for nodes are created.
      'edit bar node url alias',
      'edit foo node url alias',
      // Make sure permissions are created for entities that don't support
      // bundles.
      'edit entity_test url alias',
    ], array_keys($this->urlAliasPermPermissions->urlAliasPermissions()));

    $this->createContentType(['type' => 'test']);

    $this->assertEquals([
      'edit bar node url alias',
      'edit foo node url alias',
      'edit test node url alias',
      'edit entity_test url alias',
    ], array_keys($this->urlAliasPermPermissions->urlAliasPermissions()));

    $node_type = $this->nodeTypeStorage->load('test');
    $node_type->delete();

    $this->assertEquals([
      'edit bar node url alias',
      'edit foo node url alias',
      'edit entity_test url alias',
    ], array_keys($this->urlAliasPermPermissions->urlAliasPermissions()));

    // Make sure permissions for taxonomies are also created.
    $vocabulary = $this->createVocabulary();

    $this->assertEquals([
      'edit bar node url alias',
      'edit foo node url alias',
      'edit entity_test url alias',
      'edit ' . $vocabulary->id() . ' taxonomy_term url alias',
    ], array_keys($this->urlAliasPermPermissions->urlAliasPermissions()));
  }

}
