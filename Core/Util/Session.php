<?php

declare(strict_types=1);

namespace Core\Util;

/**
 * Class Session
 * @package Core\Util
 */
class Session
{
    private ?string $sessionId = null;
    private ?string $isActive = 'false';
    private ?int $activationTime = null;
    private ?string $csrfToken = null;

    public function __construct()
    {
        if (\session_status() === PHP_SESSION_NONE)
        {
            session_start();
            $this->isActive = 'true';
            $this->activationTime = time();
            $this->sessionId = session_id();
            try
            {
                $this->csrfToken = \bin2hex(\random_bytes(32));
            }
            catch (\Exception $exception)
            {
                $this->destroy();
            }

            $this->addKeyValuePair('isActive', (string)$this->isActive);
            $this->addKeyValuePair('activationTime', (string)$this->activationTime);
            $this->addKeyValuePair('sessionId', $this->sessionId);
            $this->addKeyValuePair('$csrfToken', $this->csrfToken);
        }
    }

    /**
     * @param int $userId
     *
     * @return void
     */
    public function login(int $userId): void
    {
        $this->addKeyValuePair('userId', (string)$userId);
        $this->addKeyValuePair('isLoggedIn', 'true');
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->removeValue('userId');
        $this->removeValue('isLoggedIn');

        $this->destroy();
    }

    /**
     * @param $userId
     */
    public function authenticate($userId)
    {
        if (!isset($_SESSION['isLoggedIn']) || $userId !== $_SESSION['userId'] || isset($_SESSION['userId']))
        {
            header('Location: /login');
        }
    }

    public static function isLoggedIn(): bool
    {
        if (!empty($_SESSION['isLoggedIn']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function addKeyValuePair(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getValue(string $key): ?string
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public function removeValue(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $_SESSION = array();
        session_destroy();
    }
}
