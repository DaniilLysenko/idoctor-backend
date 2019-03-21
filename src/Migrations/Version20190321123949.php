<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190321123949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE announcement (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(500) NOT NULL, date DATETIME NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hospital (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, patron_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, hospital_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, patron_name VARCHAR(255) NOT NULL, birthday DATE NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, street VARCHAR(500) NOT NULL, street_number VARCHAR(255) NOT NULL, apartment_number VARCHAR(255) DEFAULT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, INDEX IDX_8D93D64963DBB69 (hospital_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64963DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64963DBB69');
        $this->addSql('DROP TABLE announcement');
        $this->addSql('DROP TABLE hospital');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE user');
    }
}
