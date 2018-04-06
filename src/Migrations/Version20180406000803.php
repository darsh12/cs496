<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180406000803 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE char_card DROP FOREIGN KEY FK_66D1E68F36449AE8');
        $this->addSql('ALTER TABLE custom_card DROP FOREIGN KEY FK_1762502E5E4AA57D');
        $this->addSql('DROP TABLE char_card_stat');
        $this->addSql('DROP TABLE custom_card_stat');
        $this->addSql('DROP INDEX IDX_66D1E68F36449AE8 ON char_card');
        $this->addSql('ALTER TABLE char_card ADD hit_points INT NOT NULL, ADD attack INT NOT NULL, ADD defense INT NOT NULL, ADD agility INT NOT NULL, ADD luck INT NOT NULL, ADD speed INT NOT NULL, DROP char_stat_id');
        $this->addSql('DROP INDEX IDX_1762502E5E4AA57D ON custom_card');
        $this->addSql('ALTER TABLE custom_card ADD hit_points INT NOT NULL, ADD attack INT NOT NULL, ADD defense INT NOT NULL, ADD agility INT NOT NULL, ADD luck INT NOT NULL, ADD speed INT NOT NULL, DROP card_stat_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE char_card_stat (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_card_stat (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE char_card ADD char_stat_id INT DEFAULT NULL, DROP hit_points, DROP attack, DROP defense, DROP agility, DROP luck, DROP speed');
        $this->addSql('ALTER TABLE char_card ADD CONSTRAINT FK_66D1E68F36449AE8 FOREIGN KEY (char_stat_id) REFERENCES char_card_stat (id)');
        $this->addSql('CREATE INDEX IDX_66D1E68F36449AE8 ON char_card (char_stat_id)');
        $this->addSql('ALTER TABLE custom_card ADD card_stat_id INT DEFAULT NULL, DROP hit_points, DROP attack, DROP defense, DROP agility, DROP luck, DROP speed');
        $this->addSql('ALTER TABLE custom_card ADD CONSTRAINT FK_1762502E5E4AA57D FOREIGN KEY (card_stat_id) REFERENCES custom_card_stat (id)');
        $this->addSql('CREATE INDEX IDX_1762502E5E4AA57D ON custom_card (card_stat_id)');
    }
}
