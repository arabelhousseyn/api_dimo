import vue from 'vue'
import router from 'vue-router'

vue.use(router)
import usineComp from './components/usineComp.vue'
import adminComp from './components/adminComp.vue'
import vendeurComp from './components/vendeurComp.vue'
import venteComp from './components/venteComp.vue'
import ventesGros from './components/ventesGros.vue'
import pvComp from './components/pvComp.vue'
//to be changed
const ph = '/ker/learn%20php/api_dimo/';

const routes = [
    {
        path : ph + "acceuil",
        name  : 'usineComp',
        component : usineComp
    },

    {
        path : ph + "admin",
        name  : 'adminComp',
        component : adminComp
    },

    {
        path : ph + "vendeur",
        name  : 'vendeurComp',
        component : vendeurComp
    },

    {
        path :  ph +  "vente",
        name  : 'venteComp',
        component : venteComp
    },

    {
        path : ph + "vente_gros",
        name  : 'ventesGros',
        component : ventesGros
    },

    {
        path : ph + "prevente",
        name  : 'pvComp',
        component : pvComp
    },
]

export default new router({
    mode : "history",
    base: process.env.BASE_URL,
    routes,
});
