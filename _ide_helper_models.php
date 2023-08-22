<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $prenoms
 * @property string $nom
 * @property string $telephone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePrenoms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperClient {}
}

namespace App\Models{
/**
 * App\Models\Compte
 *
 * @property int $id
 * @property int $solde
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Compte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Compte query()
 * @method static \Illuminate\Database\Eloquent\Builder|Compte whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compte whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compte whereSolde($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Compte whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperCompte {}
}

namespace App\Models{
/**
 * App\Models\Entree
 *
 * @property int $id
 * @property int $produit_id
 * @property int $quantite
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Entree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entree query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entree whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entree wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entree whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entree whereQuantite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entree whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperEntree {}
}

namespace App\Models{
/**
 * App\Models\Produit
 *
 * @property int $id
 * @property string $reference
 * @property string $libelle
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Produit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperProduit {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $libelle
 * @property int $niveau
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereNiveau($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * App\Models\Sortie
 *
 * @property int $id
 * @property int $vente_id
 * @property int $produit_id
 * @property int $quantite
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereQuantite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sortie whereVenteId($value)
 * @mixin \Eloquent
 */
	class IdeHelperSortie {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperUserRole {}
}

namespace App\Models{
/**
 * App\Models\Vente
 *
 * @property int $id
 * @property string $libelle
 * @property string $etat
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vente whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperVente {}
}

