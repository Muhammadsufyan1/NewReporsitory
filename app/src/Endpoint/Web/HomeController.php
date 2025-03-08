<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use Exception;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use App\Entity\Order;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Http\Response\JsonResponse;
use Cycle\Database\DatabaseProviderInterface;
use Cycle\Database\Query\Expression;
/**
 * Simple home page controller. It renders home page template and also provides
 * an example of exception page.
 */
final class HomeController
{
    /**
     * Read more about Prototyping:
     * @link https://spiral.dev/docs/basics-prototype/#installation
     */
    use PrototypeTrait;
    private DatabaseProviderInterface $db;

    public function __construct(DatabaseProviderInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/', name: 'index')]
    public function index(): string
    {
        return $this->views->render('home');
    }

    /**
     * Example of exception page.
     */
    #[Route(route: '/exception', name: 'exception')]
    public function exception(): never
    {
        throw new Exception('This is a test exception.');
    }

    #[Route(route: '/monthly-sales-by-region', name: 'monthlysales')]
    public function monthlySalesByRegion()
    {
        $db = $this->db->database('default');
    
        $sql = "SELECT 
                    YEAR(order_date) AS year, 
                    MONTH(order_date) AS month, 
                    region_id, 
                    SUM(unit_price) AS total_sales, 
                    COUNT(order_id) AS number_of_orders 
                FROM orders 
                JOIN stores ON stores.store_id = orders.store_id
                WHERE order_date >= :date 
                GROUP BY year, month, region_id 
                ORDER BY year DESC, month DESC";
    
        $data = $db->query($sql, ['date' => (new \DateTime('-12 months'))->format('Y-m-d')])->fetchAll();
    
        return $this->views->render('monthly_sale.dark.php', ['data' => $data]);
    }
    #[Route(route: '/top-categories-by-store', name: 'topcategories')]
    public function TopCategoriesByStores()
    {
        $db = $this->db->database('default');
    
        $sql = "SELECT 
                    o.store_id, 
                    p.category_id, 
                    SUM(o.unit_price) AS total_sales, 
                    RANK() OVER (PARTITION BY o.store_id ORDER BY SUM(o.unit_price) DESC) AS category_rank
                FROM orders o
                JOIN products p ON o.product_id = p.product_id
                GROUP BY o.store_id, p.category_id
                ORDER BY o.store_id, category_rank";
    
        $data = $db->query($sql)->fetchAll();
    
        return $this->views->render('top_categories.dark.php', ['data' => $data]);
    }
}
