<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327084745 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coche ADD modelo_id INT NOT NULL, ADD marca_id INT NOT NULL, ADD concesionario_id INT NOT NULL');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD4C3A9576E FOREIGN KEY (modelo_id) REFERENCES modelo (id)');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD481EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('ALTER TABLE coche ADD CONSTRAINT FK_A1981CD4A7CF611B FOREIGN KEY (concesionario_id) REFERENCES concesionario (id)');
        $this->addSql('CREATE INDEX IDX_A1981CD4C3A9576E ON coche (modelo_id)');
        $this->addSql('CREATE INDEX IDX_A1981CD481EF0041 ON coche (marca_id)');
        $this->addSql('CREATE INDEX IDX_A1981CD4A7CF611B ON coche (concesionario_id)');
        $this->addSql('ALTER TABLE modelo ADD marca_id INT NOT NULL');
        $this->addSql('ALTER TABLE modelo ADD CONSTRAINT FK_F0D76C4681EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('CREATE INDEX IDX_F0D76C4681EF0041 ON modelo (marca_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coche DROP FOREIGN KEY FK_A1981CD4C3A9576E');
        $this->addSql('ALTER TABLE coche DROP FOREIGN KEY FK_A1981CD481EF0041');
        $this->addSql('ALTER TABLE coche DROP FOREIGN KEY FK_A1981CD4A7CF611B');
        $this->addSql('DROP INDEX IDX_A1981CD4C3A9576E ON coche');
        $this->addSql('DROP INDEX IDX_A1981CD481EF0041 ON coche');
        $this->addSql('DROP INDEX IDX_A1981CD4A7CF611B ON coche');
        $this->addSql('ALTER TABLE coche DROP modelo_id, DROP marca_id, DROP concesionario_id');
        $this->addSql('ALTER TABLE modelo DROP FOREIGN KEY FK_F0D76C4681EF0041');
        $this->addSql('DROP INDEX IDX_F0D76C4681EF0041 ON modelo');
        $this->addSql('ALTER TABLE modelo DROP marca_id');
    }
}
