<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Sellable;
use App\Models\SellableField;

class SellableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serv_prov = Role::with('users')->where('name', 'Service Provider')->first()->users()->first();

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Nettoyage des vitres';
        $service->price = 130;
        $service->image = null;
        $service->description = 'Nous nettoyons vos vitres dans les endroits les plus compliqués pour vous. Le prix est indiqué à l\'heure.';
        $service->owner()->associate($serv_prov);

        $service->save();

        $serv_prov = User::find(3);

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Création de site web';
        $service->price = 120;
        $service->image = null;
        $service->description = 'Envie d\'un projet de site internet d\'une qualité professionelle ? Nous sommes la pour vous! L\'utilisation de la méthodologie SCRUM vous permettra de suivre 
                                    l\'avancement tout au long du projet. Le prix indiqué est le prix d\'un Story Point';
        $service->owner()->associate($serv_prov);

        $service->save();

        $serv_prov = User::find(3);

        $service = new Sellable();
        $service->type = 1;
        $service->name = 'Visites guidées du Valais';
        $service->price = 80;
        $service->image = null;
        $service->description = 'Nos guides vous feront découvrir la région de votre choix et vous expliqueront les traditions locales de ce lieu. Le prix est indiqué par personne par heure. Les groupes doivent être composés de minimum 3 personnes et maximum 15.';
        $service->owner()->associate($serv_prov);

        $service->save();
    }
}
