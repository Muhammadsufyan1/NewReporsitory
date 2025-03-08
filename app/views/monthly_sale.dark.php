<extends:layout.base title="[[The PHP Framework for future Innovators]]"/>

<stack:push name="styles">
    <link rel="stylesheet" href="/styles/welcome.css"/>
</stack:push>

<define:body>
    <h1 class="main-title">KC Reports test</h1>

    <div class="box">
        <div class="box mt-4">
            <h2>Monthly Sales by Region</h2>
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Region ID</th>
                        <th>Total Sales</th>
                        <th>Number of Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['year']); ?></td>
                            <td><?php echo htmlspecialchars($row['month']); ?></td>
                            <td><?php echo htmlspecialchars($row['region_id']); ?></td>
                            <td><?php echo number_format($row['total_sales'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['number_of_orders']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
     </div>
</define:body>
