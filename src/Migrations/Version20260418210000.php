<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260418210000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create users and notes tables with initial data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT NOT NULL,
                username VARCHAR(25) NOT NULL,
                password VARCHAR(64) NOT NULL,
                email VARCHAR(60) NOT NULL,
                is_active TINYINT(1) NOT NULL,
                roles LONGTEXT NOT NULL COMMENT '(DC2Type:simple_array)',
                UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username),
                UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        SQL);

        $this->addSql(<<<'SQL'
            CREATE TABLE IF NOT EXISTS notes (
                id INT AUTO_INCREMENT NOT NULL,
                title VARCHAR(100) NOT NULL,
                img VARCHAR(300) DEFAULT NULL,
                date DATE NOT NULL,
                text LONGTEXT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        SQL);

        $this->addSql("INSERT INTO users (id, username, password, email, is_active, roles) VALUES (1, 'wulfy', '\$2y\$12\$Ti22gWmjxf9yPel5.gHnAeFBNQ3oJnlV8JREIOjjXN6kLODtJGKC6', 'wulfy72@yahoo.fr', 1, 'ROLE_ADMIN')");

        $this->addSql(<<<'SQL'
            INSERT INTO notes (id, title, img, date, text) VALUES
            (1, 'Poubelles', 'http://www.ville-saint-maurice.com/images/img_poubelle_humoristique.jpg', '2015-09-25', '<b>Rappel:</b> Les poubelles sont destines aux ordures menageres.\r\nLes cartons doivent tre dcoups avant d\'tre jets dans les poubelles jaunes prvues  cet effet.\r\n<br><br>\r\nLes encombrants ou cartons trop gros doivent tre jet  la dchetterie de <a href=\"https://www.google.fr/maps/place/D%C3%A9chetterie+Sathonay-Camp/@45.8250163,4.8847961,15z/data=!4m2!3m1!1s0x0:0x2bbffecdce9291f1\">  &nbsp; Sathonay-Camp <img src=\"http://www.whitakergroup.net/wp-content/uploads/2012/08/whitakergroup-google-location-icon-195x300.png\" width=\"20px\" > </a>'),
            (3, 'Conseil', 'http://leclos3.free.fr/images/logo_cs.jpg', '2016-02-12', 'Retrouvez les actions du conseil  cette adresse:\r\n<a href=\"https://docs.google.com/spreadsheets/d/1UrVb8P6RuqM1iB8VpxRe85f8MRRuAjIrvFz-Nip_NqE/edit\"> Actions en cours </a>'),
            (4, 'Propret des parties communes', 'http://www.lesinrocks.com/wp-content/thumbnails/uploads/2012/06/chien-tt-width-604-height-410-lazyload-0-crop-0-bgcolor-000000.jpg', '2016-02-12', 'Aidez-nous  conserver les parties communes de la co-proprit propres. <br/>\r\nNos amis  4 pattes sont pris de se soulager  l\'extrieur de la co-proprit. <br/><br/>\r\n<b>N\'oubliez pas de ramasser leurs djections.</b>'),
            (5, 'Places de parking', 'http://www.seton.fr/media/catalog/product/cache/1/image/85e4522595efc69f496374d01ef2bf13/1425062629/d/m/dmeu_tcr44_25_1_std.lang.all.png', '2016-02-12', 'Les places de parking extrieures de la co-proprit sont destines aux visiteurs. Merci de ne pas les occuper systmatiquement.<br>\r\nCertains rsidents ont une mobilit rduite, il est donc primordiale de ne <b>PAS</b> encombrer/utiliser la place qui leur est rserve.<br>\r\n<br>\r\nmerci !')
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS notes');
        $this->addSql('DROP TABLE IF EXISTS users');
    }
}
