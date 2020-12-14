<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link :to='acceuil' exact><a class="navbar-brand" >API_DIMO+</a></router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link :to="admin" exact>
        <a class="nav-link" >Administrateurs</a>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link :to="vendeur" exact>
        <a class="nav-link" >Vendeurs</a>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link :to="vente" exact>
        <a class="nav-link" >Vente</a>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link :to="gros" exact>
        <a class="nav-link" >Vente_gros</a>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link :to="pv" exact>
        <a class="nav-link" >Prevente</a>
        </router-link>
      </li>

      <li style='float:right;' class="nav-item">
        <a class="nav-link" style='float:right;' :href="logout" >Dèconnexion</a>
      </li>

    </ul>
  </div>
</nav>
    </header>
</template>

<script>
export default {
    data()
    {
        return{
           acceuil : '',
           admin : '',
           vendeur : '',
           vente : '',
           gros : '',
           pv : '',
           logout : '',
        }
    },
    created()
    {
        this.acceuil = this.getUrl() + 'acceuil'
        this.admin = this.getUrl() + 'admin'
        this.vendeur = this.getUrl() + 'vendeur'
        this.vente = this.getUrl() + 'vente'
        this.gros = this.getUrl() + 'vente_gros'
        this.pv = this.getUrl() + 'prevente'
        this.logout = this.getUrl() + 'logout/logout/'
    }
}
</script>