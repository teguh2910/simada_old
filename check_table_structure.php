<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Check RFQ table columns
    $rfqColumns = DB::select("DESCRIBE rfqs");
    echo "RFQ table structure:\n";
    foreach ($rfqColumns as $column) {
        echo "- {$column->Field}: {$column->Type} " . ($column->Null === 'YES' ? '(nullable)' : '(not null)') . "\n";
    }

    echo "\nChecking migrations table:\n";
    $migrations = DB::table('migrations')->where('migration', 'like', '%pic%')->get();
    foreach ($migrations as $migration) {
        echo "- {$migration->migration} (batch: {$migration->batch})\n";
    }

    // Try to create the PIC table manually
    echo "\nCreating PIC table manually...\n";
    DB::statement("
        CREATE TABLE pics (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NULL,
            phone VARCHAR(20) NULL,
            department VARCHAR(255) NULL,
            position VARCHAR(255) NULL,
            is_active TINYINT(1) NOT NULL DEFAULT 1,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8
    ");
    echo "PIC table created successfully!\n";

    // Now check PIC table structure
    echo "\nPIC table structure after creation:\n";
    $picColumns = DB::select("DESCRIBE pics");
    foreach ($picColumns as $column) {
        echo "- {$column->Field}: {$column->Type} " . ($column->Null === 'YES' ? '(nullable)' : '(not null)') . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}