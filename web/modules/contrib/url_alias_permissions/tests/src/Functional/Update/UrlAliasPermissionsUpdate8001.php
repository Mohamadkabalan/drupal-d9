<?php

namespace Drupal\Tests\url_alias_permissions\Functional\Update;

use Drupal\FunctionalTests\Update\UpdatePathTestBase;

/**
 * Update test that checks if the permissions are converted to the new ones.
 *
 * @group url_alias_permissions
 */
class UrlAliasPermissionsUpdate8001 extends UpdatePathTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'node',
    'user',
    'url_alias_permissions',
  ];

  /**
   * The role storage.
   *
   * @var \Drupal\user\RoleStorageInterface
   */
  protected $roleStorage;

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles() {
    $this->databaseDumpFiles = [
      DRUPAL_ROOT . '/core/modules/system/tests/fixtures/update/drupal-8.8.0.bare.standard.php.gz',
      __DIR__ . '/../../../fixtures/update/url-alias-permissions-update-8000.php',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();

    $this->roleStorage = $this->container->get('entity_type.manager')->getStorage('user_role');
  }

  /**
   * Update test that checks if the permissions are converted to the new ones.
   *
   * @see url_alias_permissions_update_8001()
   */
  public function testUpdate8001() {
    // Check that the authenticated and anonymous roles have the old
    // permissions before the update. This functionality is tested with the
    // anonymous user because the administrator role is an admin role and
    // always return true when calling hasPermission. Even when the permission
    // no longer exists.
    /** @var \Drupal\user\Entity\Role $authenticated */
    $authenticated = $this->roleStorage->loadUnchanged('authenticated');
    $this->assertTrue($authenticated->hasPermission('edit article URL alias'));
    $this->assertFalse($authenticated->hasPermission('edit page URL alias'));

    /** @var \Drupal\user\Entity\Role $anonymous */
    $anonymous = $this->roleStorage->loadUnchanged('anonymous');
    $this->assertTrue($anonymous->hasPermission('edit article URL alias'));
    $this->assertTrue($anonymous->hasPermission('edit page URL alias'));

    $this->runUpdates();

    // Check that the old permissions are no longer present and are replaced
    // with the new ones.
    $authenticated = $this->roleStorage->loadUnchanged('authenticated');
    $this->assertFalse($authenticated->hasPermission('edit article URL alias'));
    $this->assertFalse($authenticated->hasPermission('edit page URL alias'));
    $this->assertTrue($authenticated->hasPermission('edit article node url alias'));
    $this->assertFalse($authenticated->hasPermission('edit page node url alias'));

    $anonymous = $this->roleStorage->loadUnchanged('anonymous');
    $this->assertFalse($anonymous->hasPermission('edit article URL alias'));
    $this->assertFalse($anonymous->hasPermission('edit page URL alias'));
    $this->assertTrue($anonymous->hasPermission('edit article node url alias'));
    $this->assertTrue($anonymous->hasPermission('edit page node url alias'));
  }

}
