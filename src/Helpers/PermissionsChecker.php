<?php

namespace NawrasBukhari\LaravelInstaller\Helpers;

class PermissionsChecker
{
    protected array $results = [];

    /**
     * Set the result array permissions and errors.
     *
     * @return void
     */
    public function __construct()
    {
        $this->results['permissions'] = [];

        $this->results['errors'] = null;
    }

    /**
     * Check for the folder permissions.
     */
    public function check(array $folders): array
    {
        foreach ($folders as $folder => $permission) {
            if (! ($this->getPermission($folder) >= $permission)) {
                $this->addFileAndSetErrors($folder, $permission);
            } else {
                $this->addFile($folder, $permission, true);
            }
        }

        return $this->results;
    }

    /**
     * Get a folder permission.
     */
    private function getPermission($folder): string
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }

    /**
     * Add the file to the list of results.
     */
    private function addFile($folder, $permission, $isSet): void
    {
        $this->results['permissions'][] = [
            'folder' => $folder,
            'permission' => $permission,
            'isSet' => $isSet,
        ];
    }

    /**
     * Add the file and set the errors.
     */
    private function addFileAndSetErrors($folder, $permission): void
    {
        $this->addFile($folder, $permission, false);

        $this->results['errors'] = true;
    }
}
