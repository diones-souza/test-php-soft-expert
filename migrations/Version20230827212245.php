<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827212245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sale_products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sales_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE taxes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE types_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE products (id INT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(8, 2) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC54C8C93 ON products (type_id)');
        $this->addSql('CREATE TABLE sale_products (id INT NOT NULL, sale_id INT DEFAULT NULL, product_id INT DEFAULT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ADCEB6F04A7E4868 ON sale_products (sale_id)');
        $this->addSql('CREATE INDEX IDX_ADCEB6F04584665A ON sale_products (product_id)');
        $this->addSql('CREATE TABLE sales (id INT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE taxes (id INT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, rate NUMERIC(8, 2) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C28EA7F8C54C8C93 ON taxes (type_id)');
        $this->addSql('CREATE TABLE types (id INT NOT NULL, name VARCHAR(255) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sale_products ADD CONSTRAINT FK_ADCEB6F04A7E4868 FOREIGN KEY (sale_id) REFERENCES sales (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sale_products ADD CONSTRAINT FK_ADCEB6F04584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE taxes ADD CONSTRAINT FK_C28EA7F8C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sale_products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sales_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE taxes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE types_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5AC54C8C93');
        $this->addSql('ALTER TABLE sale_products DROP CONSTRAINT FK_ADCEB6F04A7E4868');
        $this->addSql('ALTER TABLE sale_products DROP CONSTRAINT FK_ADCEB6F04584665A');
        $this->addSql('ALTER TABLE taxes DROP CONSTRAINT FK_C28EA7F8C54C8C93');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE sale_products');
        $this->addSql('DROP TABLE sales');
        $this->addSql('DROP TABLE taxes');
        $this->addSql('DROP TABLE types');
        $this->addSql('DROP TABLE users');
    }
}
