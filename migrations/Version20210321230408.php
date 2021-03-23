<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210321230408 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dispo_ah DROP FOREIGN KEY fk_medecin');
        $this->addSql('DROP INDEX fk_medecin ON dispo_ah');
        $this->addSql('ALTER TABLE dispo_ah ADD refto_med_id_id INT DEFAULT NULL, DROP refto_med_id');
        $this->addSql('ALTER TABLE dispo_ah ADD CONSTRAINT FK_60E3DAEA7D7EFA1F FOREIGN KEY (refto_med_id_id) REFERENCES medecin (id)');
        $this->addSql('CREATE INDEX IDX_60E3DAEA7D7EFA1F ON dispo_ah (refto_med_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dispo_ah DROP FOREIGN KEY FK_60E3DAEA7D7EFA1F');
        $this->addSql('DROP INDEX IDX_60E3DAEA7D7EFA1F ON dispo_ah');
        $this->addSql('ALTER TABLE dispo_ah ADD refto_med_id INT NOT NULL, DROP refto_med_id_id');
        $this->addSql('ALTER TABLE dispo_ah ADD CONSTRAINT fk_medecin FOREIGN KEY (refto_med_id) REFERENCES medecin (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_medecin ON dispo_ah (refto_med_id)');
    }
}
