<?php

class PermissionService
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Check if a user has access to a specific page link
     */
    public function checkAccess($userId, $link)
    {

        $sql = "
            SELECT 1
            FROM permission_list pl
            INNER JOIN role_permissions rp ON rp.Permission = pl.id
            INNER JOIN users u ON u.RoleID = rp.RoleID
            WHERE u.UserID = :user_id
              AND pl.link = :link
              AND pl.Deleted = 0
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $stmt->bindValue(":link", $link, PDO::PARAM_STR);
        $stmt->execute();

        return (bool) $stmt->fetchColumn();
    }
}
