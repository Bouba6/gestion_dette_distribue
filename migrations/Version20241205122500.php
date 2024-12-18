<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205122500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "article" (id SERIAL NOT NULL, libelle VARCHAR(255) NOT NULL, qte_stock DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "client" (id SERIAL NOT NULL, users_id INT DEFAULT NULL, telephone VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045567B3B43D ON "client" (users_id)');
        $this->addSql('COMMENT ON COLUMN "client".create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "client".update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE detail_dette (id SERIAL NOT NULL, dette_id_id INT NOT NULL, article_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEEB0351A42126FB ON detail_dette (dette_id_id)');
        $this->addSql('CREATE INDEX IDX_FEEB03518F3EC46 ON detail_dette (article_id_id)');
        $this->addSql('CREATE TABLE "dette" (id SERIAL NOT NULL, client_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, montant_verser DOUBLE PRECISION NOT NULL, etat_dette VARCHAR(255) NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_831BC80819EB6921 ON "dette" (client_id)');
        $this->addSql('COMMENT ON COLUMN "dette".create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "dette".update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(100) NOT NULL, login VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_blocked BOOLEAN NOT NULL, roles JSON NOT NULL, File VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9AA08CB10 ON users (login)');
        $this->addSql('COMMENT ON COLUMN users.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE "client" ADD CONSTRAINT FK_C744045567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detail_dette ADD CONSTRAINT FK_FEEB0351A42126FB FOREIGN KEY (dette_id_id) REFERENCES "dette" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detail_dette ADD CONSTRAINT FK_FEEB03518F3EC46 FOREIGN KEY (article_id_id) REFERENCES "article" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "dette" ADD CONSTRAINT FK_831BC80819EB6921 FOREIGN KEY (client_id) REFERENCES "client" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "client" DROP CONSTRAINT FK_C744045567B3B43D');
        $this->addSql('ALTER TABLE detail_dette DROP CONSTRAINT FK_FEEB0351A42126FB');
        $this->addSql('ALTER TABLE detail_dette DROP CONSTRAINT FK_FEEB03518F3EC46');
        $this->addSql('ALTER TABLE "dette" DROP CONSTRAINT FK_831BC80819EB6921');
        $this->addSql('DROP TABLE "article"');
        $this->addSql('DROP TABLE "client"');
        $this->addSql('DROP TABLE detail_dette');
        $this->addSql('DROP TABLE "dette"');
        $this->addSql('DROP TABLE users');
    }
}
