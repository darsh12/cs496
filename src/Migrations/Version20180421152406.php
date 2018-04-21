<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180421152406 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_char_decks CHANGE card1_id card1_id INT NOT NULL, CHANGE card2_id card2_id INT NOT NULL, CHANGE card3_id card3_id INT NOT NULL, CHANGE card4_id card4_id INT NOT NULL, CHANGE card5_id card5_id INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_char_decks CHANGE card1_id card1_id INT DEFAULT NULL, CHANGE card2_id card2_id INT DEFAULT NULL, CHANGE card3_id card3_id INT DEFAULT NULL, CHANGE card4_id card4_id INT DEFAULT NULL, CHANGE card5_id card5_id INT DEFAULT NULL');
    }
}
