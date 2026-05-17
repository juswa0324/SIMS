#!/bin/bash

DB_USER="gflmci"
DB_PASS="your_Airetow321"
DB_NAME="your_gflmci"

echo "Running migrations..."
for f in migrations/*.sql; do
    echo "Applying $f..."
    mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$f"
done

echo "Running stored procedures..."
for f in procedures/*.sql; do
    echo "Applying $f..."
    mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$f"
done

echo "Running seed data..."
for f in seeds/*.sql; do
    echo "Applying $f..."
    mysql -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$f"
done

echo "All scripts executed."