<template>
    <section id='gros'>
      <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usines</label>
    <select @change="generateVendeur" v-model="dataEntry.idu" class="form-control" id="exampleFormControlSelect1">
      <option v-for="us in usine" :key="us.idu" :value="us.idu"> {{ us.nomu }} </option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect2" style='font-weight:bold;'>Vendeurs</label>
    <select @change="generateVente" v-model="dataEntry.idv" class="form-control" id="exampleFormControlSelect2">
      <option v-for="vnd in vendeurs" :key="vnd.idv" :value="vnd.idv"> {{ vnd.nomc }} </option>
    </select>
  </div>
  <div v-if="load" style='text-align:center;' class="content">
    <div class="form-group">
    <label for="exampleFormControlSelect2" style='font-weight:bold;'>Date de ventes gros</label>
    <select  v-model="dataEntry.date" class="form-control" id="exampleFormControlSelect2">
      <option v-for="vn in vents" :key="vn.idve" :value="vn.date"> {{ vn.date }} </option>
    </select>
  </div>
    <button @click="deleteVente" class='btn btn-danger'>Supprimer La vente gros</button>
  </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props : ['usine'],
    data()
    {
        return{
           dataEntry : {
               idu : '',
               idv : '',
               date : ''
           },
           vendeurs : [],
           vents : [],
           load : false,
        }
    },
    methods : {
      async generateVendeur()
      {
          const res  = await this.callApi('POST','data/getVendeurByidu',this.dataEntry)
          if(res.status === 200)
          {
            this.vendeurs = res.data
          }
      },
      async generateVente()
      {
          const res = await this.callApi('POST','data/getAllventesGrosByVendeur',this.dataEntry)
          if(res.status === 200)
          {
              this.load = true
            this.vents = res.data
          }
      },
      async deleteVente()
      {
          const res = await this.callApi('POST','data/deleteVentesGrosByVendeur',this.dataEntry)
          if(res.status === 200)
          {
              this.statu('Opèration èffectuè','success')
          }
      }
    }
}
</script>