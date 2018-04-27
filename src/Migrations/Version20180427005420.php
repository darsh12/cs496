<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180427005420 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE custom_card_vote (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, custom_card_id INT NOT NULL, vote VARCHAR(255) NOT NULL, INDEX IDX_FC19F060A76ED395 (user_id), INDEX IDX_FC19F0604D95F3ED (custom_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE custom_card_vote ADD CONSTRAINT FK_FC19F060A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE custom_card_vote ADD CONSTRAINT FK_FC19F0604D95F3ED FOREIGN KEY (custom_card_id) REFERENCES custom_card (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE custom_card_vote');
    }
}
