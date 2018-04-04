<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180404154741 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achievement (id INT AUTO_INCREMENT NOT NULL, reward_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, count_value INT NOT NULL, INDEX IDX_96737FF1E466ACA1 (reward_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atk_util_effect (id INT AUTO_INCREMENT NOT NULL, attribute_mod INT NOT NULL, card_swap INT NOT NULL, hide_char INT NOT NULL, hide_util INT NOT NULL, hide_type INT NOT NULL, hide_class INT NOT NULL, hide_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battle (id INT AUTO_INCREMENT NOT NULL, winner_id INT DEFAULT NULL, defend_char_deck_id INT DEFAULT NULL, defend_util_deck_id INT DEFAULT NULL, request_id INT DEFAULT NULL, battle_datetime DATETIME NOT NULL, battle_report VARCHAR(255) NOT NULL, INDEX IDX_139917345DFCD4B8 (winner_id), INDEX IDX_139917348D0AC321 (defend_char_deck_id), INDEX IDX_13991734BD160426 (defend_util_deck_id), INDEX IDX_13991734427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE battle_request (id INT AUTO_INCREMENT NOT NULL, attacker_id INT DEFAULT NULL, defender_id INT DEFAULT NULL, attack_char_deck_id INT DEFAULT NULL, attack_util_deck_id INT DEFAULT NULL, datetime DATETIME NOT NULL, INDEX IDX_F1083BFC65F8CAE3 (attacker_id), INDEX IDX_F1083BFC4A3E3B6F (defender_id), INDEX IDX_F1083BFCCFB727A5 (attack_char_deck_id), INDEX IDX_F1083BFCFFABE0A2 (attack_util_deck_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_card (id INT AUTO_INCREMENT NOT NULL, char_stat_id INT DEFAULT NULL, avatar_id INT DEFAULT NULL, char_name VARCHAR(255) NOT NULL, char_type VARCHAR(255) NOT NULL, char_class VARCHAR(255) NOT NULL, char_tier VARCHAR(255) NOT NULL, INDEX IDX_66D1E68F36449AE8 (char_stat_id), INDEX IDX_66D1E68F86383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_card_stat (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_deck (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, char_card1_id INT DEFAULT NULL, char_card2_id INT DEFAULT NULL, char_card3_id INT DEFAULT NULL, char_card4_id INT DEFAULT NULL, char_card5_id INT DEFAULT NULL, INDEX IDX_3F69486BA76ED395 (user_id), INDEX IDX_3F69486BD47466B6 (char_card1_id), INDEX IDX_3F69486BC6C1C958 (char_card2_id), INDEX IDX_3F69486B7E7DAE3D (char_card3_id), INDEX IDX_3F69486BE3AA9684 (char_card4_id), INDEX IDX_3F69486B5B16F1E1 (char_card5_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_card (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, card_stat_id INT DEFAULT NULL, type INT NOT NULL, votes INT NOT NULL, INDEX IDX_1762502EA76ED395 (user_id), INDEX IDX_1762502E5E4AA57D (card_stat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE custom_card_stat (id INT AUTO_INCREMENT NOT NULL, hit_points INT NOT NULL, attack INT NOT NULL, defense INT NOT NULL, agility INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE def_util_effect (id INT AUTO_INCREMENT NOT NULL, attribute_mod INT NOT NULL, card_swap INT NOT NULL, peek_char INT NOT NULL, peek_util INT NOT NULL, peek_type INT NOT NULL, peek_class INT NOT NULL, peek_order INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reward (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', googleAuthenticatorSecret VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_achievement (user_id INT NOT NULL, achievement_id INT NOT NULL, INDEX IDX_3F68B664A76ED395 (user_id), INDEX IDX_3F68B664B3EC99FE (achievement_id), PRIMARY KEY(user_id, achievement_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_char_card (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, char_card_id INT DEFAULT NULL, card_kills INT NOT NULL, card_deaths INT NOT NULL, card_count INT NOT NULL, card_uses INT NOT NULL, INDEX IDX_66316B6BA76ED395 (user_id), INDEX IDX_66316B6B75D82FC3 (char_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE char_cards (user_char_card_id INT NOT NULL, char_card_id INT NOT NULL, INDEX IDX_666F805CF51453C1 (user_char_card_id), INDEX IDX_666F805C75D82FC3 (char_card_id), PRIMARY KEY(user_char_card_id, char_card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stat (user_id INT NOT NULL, favorite_card INT DEFAULT NULL, best_win_battle INT DEFAULT NULL, worst_lost_battle INT DEFAULT NULL, most_defeated_card INT DEFAULT NULL, user_rank INT NOT NULL, user_level TIME NOT NULL, play_time INT NOT NULL, matches_won INT NOT NULL, matches_lost NUMERIC(10, 0) NOT NULL, win_loss_ratio INT NOT NULL, times_attacked INT NOT NULL, times_defended INT NOT NULL, INDEX IDX_5A39B3E8F81281EC (favorite_card), INDEX IDX_5A39B3E8A8D3A1AC (best_win_battle), INDEX IDX_5A39B3E8DAC49345 (worst_lost_battle), INDEX IDX_5A39B3E898E368AB (most_defeated_card), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_util_card (user_id INT NOT NULL, util_card_id INT NOT NULL, card_count INT NOT NULL, card_uses INT NOT NULL, INDEX IDX_98CC5978A76ED395 (user_id), INDEX IDX_98CC597845C4E8C4 (util_card_id), PRIMARY KEY(user_id, util_card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE util_card (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, attack_effect_id INT DEFAULT NULL, defense_effect_id INT DEFAULT NULL, util_name VARCHAR(255) NOT NULL, util_type VARCHAR(255) NOT NULL, util_tier VARCHAR(255) NOT NULL, INDEX IDX_982CD49C86383B10 (avatar_id), INDEX IDX_982CD49CA0D209DD (attack_effect_id), INDEX IDX_982CD49C3F1D6F78 (defense_effect_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE util_deck (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, util_card1_id INT DEFAULT NULL, util_card2_id INT DEFAULT NULL, util_card3_id INT DEFAULT NULL, INDEX IDX_C1947A78A76ED395 (user_id), INDEX IDX_C1947A784A20EFD2 (util_card1_id), INDEX IDX_C1947A785895403C (util_card2_id), INDEX IDX_C1947A78E0292759 (util_card3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achievement ADD CONSTRAINT FK_96737FF1E466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_139917345DFCD4B8 FOREIGN KEY (winner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_139917348D0AC321 FOREIGN KEY (defend_char_deck_id) REFERENCES char_deck (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_13991734BD160426 FOREIGN KEY (defend_util_deck_id) REFERENCES util_deck (id)');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_13991734427EB8A5 FOREIGN KEY (request_id) REFERENCES battle_request (id)');
        $this->addSql('ALTER TABLE battle_request ADD CONSTRAINT FK_F1083BFC65F8CAE3 FOREIGN KEY (attacker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE battle_request ADD CONSTRAINT FK_F1083BFC4A3E3B6F FOREIGN KEY (defender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE battle_request ADD CONSTRAINT FK_F1083BFCCFB727A5 FOREIGN KEY (attack_char_deck_id) REFERENCES char_deck (id)');
        $this->addSql('ALTER TABLE battle_request ADD CONSTRAINT FK_F1083BFCFFABE0A2 FOREIGN KEY (attack_util_deck_id) REFERENCES util_deck (id)');
        $this->addSql('ALTER TABLE char_card ADD CONSTRAINT FK_66D1E68F36449AE8 FOREIGN KEY (char_stat_id) REFERENCES char_card_stat (id)');
        $this->addSql('ALTER TABLE char_card ADD CONSTRAINT FK_66D1E68F86383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486BD47466B6 FOREIGN KEY (char_card1_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486BC6C1C958 FOREIGN KEY (char_card2_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486B7E7DAE3D FOREIGN KEY (char_card3_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486BE3AA9684 FOREIGN KEY (char_card4_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE char_deck ADD CONSTRAINT FK_3F69486B5B16F1E1 FOREIGN KEY (char_card5_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE custom_card ADD CONSTRAINT FK_1762502EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE custom_card ADD CONSTRAINT FK_1762502E5E4AA57D FOREIGN KEY (card_stat_id) REFERENCES custom_card_stat (id)');
        $this->addSql('ALTER TABLE user_achievement ADD CONSTRAINT FK_3F68B664A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_achievement ADD CONSTRAINT FK_3F68B664B3EC99FE FOREIGN KEY (achievement_id) REFERENCES achievement (id)');
        $this->addSql('ALTER TABLE user_char_card ADD CONSTRAINT FK_66316B6BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_char_card ADD CONSTRAINT FK_66316B6B75D82FC3 FOREIGN KEY (char_card_id) REFERENCES char_card (id)');
        $this->addSql('ALTER TABLE char_cards ADD CONSTRAINT FK_666F805CF51453C1 FOREIGN KEY (user_char_card_id) REFERENCES user_char_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE char_cards ADD CONSTRAINT FK_666F805C75D82FC3 FOREIGN KEY (char_card_id) REFERENCES char_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8F81281EC FOREIGN KEY (favorite_card) REFERENCES user_char_card (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8A8D3A1AC FOREIGN KEY (best_win_battle) REFERENCES battle (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8DAC49345 FOREIGN KEY (worst_lost_battle) REFERENCES battle (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E898E368AB FOREIGN KEY (most_defeated_card) REFERENCES user_char_card (id)');
        $this->addSql('ALTER TABLE user_util_card ADD CONSTRAINT FK_98CC5978A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_util_card ADD CONSTRAINT FK_98CC597845C4E8C4 FOREIGN KEY (util_card_id) REFERENCES util_card (id)');
        $this->addSql('ALTER TABLE util_card ADD CONSTRAINT FK_982CD49C86383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
        $this->addSql('ALTER TABLE util_card ADD CONSTRAINT FK_982CD49CA0D209DD FOREIGN KEY (attack_effect_id) REFERENCES atk_util_effect (id)');
        $this->addSql('ALTER TABLE util_card ADD CONSTRAINT FK_982CD49C3F1D6F78 FOREIGN KEY (defense_effect_id) REFERENCES def_util_effect (id)');
        $this->addSql('ALTER TABLE util_deck ADD CONSTRAINT FK_C1947A78A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE util_deck ADD CONSTRAINT FK_C1947A784A20EFD2 FOREIGN KEY (util_card1_id) REFERENCES util_card (id)');
        $this->addSql('ALTER TABLE util_deck ADD CONSTRAINT FK_C1947A785895403C FOREIGN KEY (util_card2_id) REFERENCES util_card (id)');
        $this->addSql('ALTER TABLE util_deck ADD CONSTRAINT FK_C1947A78E0292759 FOREIGN KEY (util_card3_id) REFERENCES util_card (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_achievement DROP FOREIGN KEY FK_3F68B664B3EC99FE');
        $this->addSql('ALTER TABLE util_card DROP FOREIGN KEY FK_982CD49CA0D209DD');
        $this->addSql('ALTER TABLE char_card DROP FOREIGN KEY FK_66D1E68F86383B10');
        $this->addSql('ALTER TABLE util_card DROP FOREIGN KEY FK_982CD49C86383B10');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8A8D3A1AC');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8DAC49345');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_13991734427EB8A5');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486BD47466B6');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486BC6C1C958');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486B7E7DAE3D');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486BE3AA9684');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486B5B16F1E1');
        $this->addSql('ALTER TABLE user_char_card DROP FOREIGN KEY FK_66316B6B75D82FC3');
        $this->addSql('ALTER TABLE char_cards DROP FOREIGN KEY FK_666F805C75D82FC3');
        $this->addSql('ALTER TABLE char_card DROP FOREIGN KEY FK_66D1E68F36449AE8');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_139917348D0AC321');
        $this->addSql('ALTER TABLE battle_request DROP FOREIGN KEY FK_F1083BFCCFB727A5');
        $this->addSql('ALTER TABLE custom_card DROP FOREIGN KEY FK_1762502E5E4AA57D');
        $this->addSql('ALTER TABLE util_card DROP FOREIGN KEY FK_982CD49C3F1D6F78');
        $this->addSql('ALTER TABLE achievement DROP FOREIGN KEY FK_96737FF1E466ACA1');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_139917345DFCD4B8');
        $this->addSql('ALTER TABLE battle_request DROP FOREIGN KEY FK_F1083BFC65F8CAE3');
        $this->addSql('ALTER TABLE battle_request DROP FOREIGN KEY FK_F1083BFC4A3E3B6F');
        $this->addSql('ALTER TABLE char_deck DROP FOREIGN KEY FK_3F69486BA76ED395');
        $this->addSql('ALTER TABLE custom_card DROP FOREIGN KEY FK_1762502EA76ED395');
        $this->addSql('ALTER TABLE user_achievement DROP FOREIGN KEY FK_3F68B664A76ED395');
        $this->addSql('ALTER TABLE user_char_card DROP FOREIGN KEY FK_66316B6BA76ED395');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8A76ED395');
        $this->addSql('ALTER TABLE user_util_card DROP FOREIGN KEY FK_98CC5978A76ED395');
        $this->addSql('ALTER TABLE util_deck DROP FOREIGN KEY FK_C1947A78A76ED395');
        $this->addSql('ALTER TABLE char_cards DROP FOREIGN KEY FK_666F805CF51453C1');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8F81281EC');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E898E368AB');
        $this->addSql('ALTER TABLE user_util_card DROP FOREIGN KEY FK_98CC597845C4E8C4');
        $this->addSql('ALTER TABLE util_deck DROP FOREIGN KEY FK_C1947A784A20EFD2');
        $this->addSql('ALTER TABLE util_deck DROP FOREIGN KEY FK_C1947A785895403C');
        $this->addSql('ALTER TABLE util_deck DROP FOREIGN KEY FK_C1947A78E0292759');
        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_13991734BD160426');
        $this->addSql('ALTER TABLE battle_request DROP FOREIGN KEY FK_F1083BFCFFABE0A2');
        $this->addSql('DROP TABLE achievement');
        $this->addSql('DROP TABLE atk_util_effect');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE battle');
        $this->addSql('DROP TABLE battle_request');
        $this->addSql('DROP TABLE char_card');
        $this->addSql('DROP TABLE char_card_stat');
        $this->addSql('DROP TABLE char_deck');
        $this->addSql('DROP TABLE custom_card');
        $this->addSql('DROP TABLE custom_card_stat');
        $this->addSql('DROP TABLE def_util_effect');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_achievement');
        $this->addSql('DROP TABLE user_char_card');
        $this->addSql('DROP TABLE char_cards');
        $this->addSql('DROP TABLE user_stat');
        $this->addSql('DROP TABLE user_util_card');
        $this->addSql('DROP TABLE util_card');
        $this->addSql('DROP TABLE util_deck');
    }
}
