<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322032035 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achievements (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, reward_id INT NOT NULL, type VARCHAR(255) NOT NULL, count_value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atk_util_effects (id INT AUTO_INCREMENT NOT NULL, attribute_mod INT NOT NULL, card_swap INT NOT NULL, hide_char INT NOT NULL, hide_util INT NOT NULL, hide_type INT NOT NULL, hide_class INT NOT NULL, hide_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatars (id INT AUTO_INCREMENT NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battle_requests (id INT AUTO_INCREMENT NOT NULL, attacker_id INT NOT NULL, defender_id INT NOT NULL, datetime DATETIME NOT NULL, attack_char_deck_id INT NOT NULL, attack_util_deck_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battles (id INT AUTO_INCREMENT NOT NULL, winner_id INT NOT NULL, battle_datetime DATETIME NOT NULL, defend_char_deck_id INT NOT NULL, defend_util_deck_id INT NOT NULL, battle_report VARCHAR(255) NOT NULL, request_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_cards (id INT AUTO_INCREMENT NOT NULL, char_name VARCHAR(255) NOT NULL, char_type VARCHAR(255) NOT NULL, char_class VARCHAR(255) NOT NULL, char_tier VARCHAR(255) NOT NULL, char_stat_id INT NOT NULL, avatar_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_card_stats (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_decks (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, card1_id INT NOT NULL, card2_id INT NOT NULL, card3_id INT NOT NULL, card4_id INT NOT NULL, card5_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_cards (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type INT NOT NULL, card_stat_id INT NOT NULL, votes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_card_stats (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE def_util_effects (id INT AUTO_INCREMENT NOT NULL, attribute_mod INT NOT NULL, card_swap INT NOT NULL, peek_char INT NOT NULL, peek_util INT NOT NULL, peek_type INT NOT NULL, peek_class INT NOT NULL, peek_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rewards (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_achievements (user_id INT NOT NULL, achievement_id INT NOT NULL, PRIMARY KEY(user_id, achievement_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_char_cards (user_id INT NOT NULL, char_card_id INT NOT NULL, card_kills INT NOT NULL, card_deaths INT NOT NULL, card_count INT NOT NULL, card_uses INT NOT NULL, PRIMARY KEY(user_id, char_card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stats (user_id INT NOT NULL, user_rank INT NOT NULL, user_level TIME NOT NULL, play_time INT NOT NULL, matches_won INT NOT NULL, matches_lost NUMERIC(10, 0) NOT NULL, win_loss_ratio INT NOT NULL, favorite_card INT NOT NULL, times_attacked INT NOT NULL, times_defended INT NOT NULL, best_win_battle INT NOT NULL, worst_lost_battle INT NOT NULL, most_defeated_card INT NOT NULL, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_util_cards (user_id INT NOT NULL, util_card_id INT NOT NULL, card_count INT NOT NULL, card_uses INT NOT NULL, PRIMARY KEY(user_id, util_card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE util_cards (id INT AUTO_INCREMENT NOT NULL, util_name VARCHAR(255) NOT NULL, util_type VARCHAR(255) NOT NULL, util_tier VARCHAR(255) NOT NULL, avatar_id INT NOT NULL, attack_effect_id INT NOT NULL, defense_effect_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE util_decks (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, card1_id INT NOT NULL, card2_id INT NOT NULL, card3_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE achievements');
        $this->addSql('DROP TABLE atk_util_effects');
        $this->addSql('DROP TABLE avatars');
        $this->addSql('DROP TABLE battle_requests');
        $this->addSql('DROP TABLE battles');
        $this->addSql('DROP TABLE char_cards');
        $this->addSql('DROP TABLE char_card_stats');
        $this->addSql('DROP TABLE char_decks');
        $this->addSql('DROP TABLE custom_cards');
        $this->addSql('DROP TABLE custom_card_stats');
        $this->addSql('DROP TABLE def_util_effects');
        $this->addSql('DROP TABLE rewards');
        $this->addSql('DROP TABLE user_achievements');
        $this->addSql('DROP TABLE user_char_cards');
        $this->addSql('DROP TABLE user_stats');
        $this->addSql('DROP TABLE user_util_cards');
        $this->addSql('DROP TABLE util_cards');
        $this->addSql('DROP TABLE util_decks');
    }
}
