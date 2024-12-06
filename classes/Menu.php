<?php

namespace classes;

class Menu
{
    private $menu = [
        0 => [
           'class' => "nav-item",
           'class-a' => "nav-link click-scroll",
           'href' => "#top",
           'content' => "Home"
        ],
        1 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_2",
            'content' => "About",
        ],
        2 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_3",
            'content' => "Causes",
        ],
        3 => [
            'class' => "nav-item",
            'class-a' => "nav-link click-scroll",
            'href' => "#section_4",
            'content' => "Volunteer",
        ],
        4 => [
            'class' => "nav-item dropdown",
            'class-a' => "nav-link click-scroll dropdown-toggle",
            'href' => "#section_5",
            'id' => "navbarLightDropdownMenuLink",
            'role' => "button",
            'data-bs-toggle' => "dropdown",
            'aria-expanded' => "false",
            'content' => "News",
            'class-ul' => "dropdown-menu dropdown-menu-light",
            'aria-labelledby' => "navbarLightDropdownMenuLink",
            "items" => [
                0 => [
                    'class' => "dropdown-item",
                    'href' => "news.php",
                    'content' => "News Listing",
                ],
                1 => [
                    'class' => "dropdown-item",
                    'href' => "news-detail.php",
                    'content' => "News Detail",
                ],
            ]
        ],
        5 => [
            'class' => "nav-item ms-3",
            'class-a' => "nav-link custom-btn custom-border-btn btn",
            'href' => "donate.php",
            'content' => "Donate",
        ],
    ];

    private $host = "localhost";
    private $dbname = "sj-2024";
    private $username = "root";
    private $password = "";
    private $port = 3307;

    private $connection;

    public function __construct()
    {
        try {
            // Vytvorenie PDO objektu a pripojenie k databáze
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->username,
                $this->password
            );
            // Nastavenie PDO pre zobrazenie chýb a vynucenie vyvolávania výnimiek
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Spracovanie chyby pripojenia
            echo "Chyba pri pripojení k databáze: " . $e->getMessage();
        }
    }


    public function getMenu($type = "header"): string
    {
        $serverUrl = $_SERVER['REQUEST_URI'];
        $urlParts = explode("/", $serverUrl);
        $newUrlParts = [];
        foreach ($urlParts as $part) {
            if(!empty($part)) {
                $newUrlParts[] = $part;
            }
        }
        $numberOfUrlParts = count($newUrlParts);
        if($numberOfUrlParts === 1) {
            $useOriginal = true;
        } elseif ($numberOfUrlParts === 2 && $newUrlParts[1] === 'index.php') {
            $useOriginal = true;
        } else {
            $useOriginal = false;
        }

        $html = "";

        if($type === "header") {
            foreach ($this->menu as $menu) {
                if(isset($menu['items'])) {
                    $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'" 
                                id="'.$menu['id'].'" 
                                role="'.$menu['role'].'" 
                                data-bs-toggle="'.$menu['data-bs-toggle'].'" 
                                aria-expanded="'.$menu['aria-expanded'].'">'.$menu['content'].'</a>

                    <ul class="'.$menu['class-ul'].'" aria-labelledby="'.$menu['aria-labelledby'].'">';
                    foreach ($menu['items'] as $item) {
                        $html .= '<li>
                                    <a 
                                    class="'.$item['class'].'" 
                                    href="'.$item['href'].'">'.$item['content'].'
                                    </a>
                                  </li>';
                    }
                    $html .= '</ul></li>';
                } else {
                    if(!$useOriginal) {
                        if($menu['href'] === $newUrlParts[1]) {
                            $link = $menu['href'];
                        } else {
                            $link = "index.php";
                        }
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$link.'">'.$menu['content'].'</a>
                              </li>';
                    } else {
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'">'.$menu['content'].'</a>
                              </li>';
                    }

                }
            }
        }

        return $html;
    }

    public function saveDataToFile()
    {
        $jsonMenu = json_encode($this->menu);
        $save = file_put_contents("menu.json", $jsonMenu);

        if($save) {
            echo "Menu bolo uspesne ulozene";
        } else {
            echo "Nastala chyba";
        }
    }

    public function getMenuFromFile($type = "header"): string
    {
        $menuDataFromFile = file_get_contents("menu.json");
        $this->menu = json_decode($menuDataFromFile, true);

        $serverUrl = $_SERVER['REQUEST_URI'];
        $urlParts = explode("/", $serverUrl);
        $newUrlParts = [];
        foreach ($urlParts as $part) {
            if(!empty($part)) {
                $newUrlParts[] = $part;
            }
        }
        $numberOfUrlParts = count($newUrlParts);
        if($numberOfUrlParts === 1) {
            $useOriginal = true;
        } elseif ($numberOfUrlParts === 2 && $newUrlParts[1] === 'index.php') {
            $useOriginal = true;
        } else {
            $useOriginal = false;
        }

        $html = "";

        if($type === "header") {
            foreach ($this->menu as $menu) {
                //$menu->items
                if(isset($menu['items'])) {
                    $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'" 
                                id="'.$menu['id'].'" 
                                role="'.$menu['role'].'" 
                                data-bs-toggle="'.$menu['data-bs-toggle'].'" 
                                aria-expanded="'.$menu['aria-expanded'].'">'.$menu['content'].'</a>

                    <ul class="'.$menu['class-ul'].'" aria-labelledby="'.$menu['aria-labelledby'].'">';
                    foreach ($menu['items'] as $item) {
                        $html .= '<li>
                                    <a 
                                    class="'.$item['class'].'" 
                                    href="'.$item['href'].'">'.$item['content'].'
                                    </a>
                                  </li>';
                    }
                    $html .= '</ul></li>';
                } else {
                    if(!$useOriginal) {
                        if($menu['href'] === $newUrlParts[1]) {
                            $link = $menu['href'];
                        } else {
                            $link = "index.php";
                        }
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$link.'">'.$menu['content'].'</a>
                              </li>';
                    } else {
                        $html .= '<li class="'.$menu['class'].'">
                                <a class="'.$menu['class-a'].'" 
                                href="'.$menu['href'].'">'.$menu['content'].'</a>
                              </li>';
                    }

                }
            }
        }

        return $html;
    }

    public function insertMenuDataToDatabase()
    {
        $menuDataFromFile = file_get_contents("menu.json");
        $this->menu = json_decode($menuDataFromFile, true);

        // Príprava SQL pre hlavné menu
        $menuInsertSQL = "INSERT INTO menu (`class`, `class-a`, `href`, `css-id`, `role`, `data-bs-toggle`, `aria-expanded`, `content`, `class-ul`, `aria-labelledby`) 
                  VALUES (:class, :class_a, :href, :css_id, :role, :data_bs_toggle, :aria_expanded, :content, :class_ul, :aria_labelledby)";
        $menuInsertStmt = $this->connection->prepare($menuInsertSQL);

        // Príprava SQL pre submenu
        $menuItemInsertSQL = "INSERT INTO menu_item (`class`, `href`, `content`, `menu_id`) 
                      VALUES (:class, :href, :content, :menu_id)";
        $menuItemInsertStmt = $this->connection->prepare($menuItemInsertSQL);

        // Spracovanie JSON dát
        foreach ($this->menu as $menu) {
            // Hodnoty pre hlavnú položku menu
            $class = $menu['class'] ?? '';
            $class_a = $menu['class-a'] ?? '';
            $href = $menu['href'] ?? '';
            $css_id = $menu['id'] ?? '';
            $role = $menu['role'] ?? '';
            $data_bs_toggle = $menu['data-bs-toggle'] ?? '';
            $aria_expanded = $menu['aria-expanded'] ?? '';
            $content = $menu['content'] ?? '';
            $class_ul = $menu['class-ul'] ?? '';
            $aria_labelledby = $menu['aria-labelledby'] ?? '';

            // Vloženie hlavnej položky menu
            $menuInsertStmt->execute([
                ':class' => $class,
                ':class_a' => $class_a,
                ':href' => $href,
                ':css_id' => $css_id,
                ':role' => $role,
                ':data_bs_toggle' => $data_bs_toggle,
                ':aria_expanded' => $aria_expanded,
                ':content' => $content,
                ':class_ul' => $class_ul,
                ':aria_labelledby' => $aria_labelledby,
            ]);

            // Získanie ID vloženej hlavnej položky
            $menuId = $this->connection->lastInsertId();

            // Spracovanie submenu položiek, ak existujú
            if (!empty($menu['items'])) {
                foreach ($menu['items'] as $item) {
                    $menuItemClass = $item['class'] ?? '';
                    $menuItemHref = $item['href'] ?? '';
                    $menuItemContent = $item['content'] ?? '';

                    // Vloženie submenu položky
                    $menuItemInsertStmt->execute([
                        ':class' => $menuItemClass,
                        ':href' => $menuItemHref,
                        ':content' => $menuItemContent,
                        ':menu_id' => $menuId,
                    ]);
                }
            }
        }
    }
}