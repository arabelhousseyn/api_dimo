<template>
    <section id='vendeur'>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#exampleModal1" class='btn btn-primary'>Ajouter</button>
                <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usines</label>
    <select @change="generateVendeur" v-model="dataEntry.idu" class="form-control" id="exampleFormControlSelect1">
      <option v-for="us in usine" :key="us.idu" :value="us.idu"> {{ us.nomu }} </option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Vendeurs</label>
    <select @change="generateVendeurById" v-model="dataEntry.idv" class="form-control" id="exampleFormControlSelect1">
        <option selected disabled>Choisir</option>
      <option v-for="vm in vendeurs" :key="vm.idv" :value="vm.idv"> {{ vm.nomc }} </option>
    </select>
  </div>

  <div v-if="load" class="show">
     <div style='text-align:center;' v-for="show in datashow" :key="show.idv" class="content">
         <h5><span style='font-weight:bold;'>Usine</span> : {{ show.idu[0].nomu }} </h5>
       <h5><span style='font-weight:bold;'>Nom</span> : {{ show.nomc }} </h5>
       <h5><span style='font-weight:bold;'>Telephone</span> : {{ show.phone }} </h5>
       <h5><span style='font-weight:bold;'>User</span> : {{ show.iden }} </h5>
       <h5><span style='font-weight:bold;'>Pass</span> : {{ show.pass }} </h5>
       <h5><span style='font-weight:bold;'>èxpiration</span> : {{ show.daten }} </h5>

       <h5 v-if="show.active == 'true'" ><span style='font-weight:bold; color:green;'>Connectè</span>
       <br>
       <button @click="disconnecte" class='btn btn-danger'>Dèconnectè</button>
       </h5>

       <h5 v-if="show.active == 'false'" ><span style='font-weight:bold; color:red;'>Dèconnectè</span></h5>

       <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Liste des client</label>
    <select v-model="dataEntry.idc" class="form-control" id="exampleFormControlSelect1">
      <option v-for="clt in clent" :key="clt.idc" :value="clt.idc" > {{ clt.nomc }} </option>
    </select>
  </div>

  <button @click="AddClient" class='btn btn-success'>Ajouter client</button>
       
       <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Liste des client appartient</label>
    <select v-model="dataEntry.idc" class="form-control" id="exampleFormControlSelect1">
      <option v-for="sh in show.clent" :key="sh.idc" :value="sh.idc" > {{ sh.nomc }} </option>
    </select>
  </div>

  <button @click="delClient" class='btn btn-danger'>Supprimer client</button>
   <div style='margin-top:20px;' class="friends">
       <button data-toggle="modal" data-target="#exampleModal" class='btn btn-success'>Modifier Vendeur</button>
     <button @click="deleteVenduer" class='btn btn-danger'>Supprimer Vendeur</button>
   </div>
     </div>
  </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div v-for="disp in datashow" :key="disp.idv" class="modal-body">
        <div class="form-group">
            <label for="namee" style='font-weight:bold;'>Nom</label>
            <input type="text" id="namee" v-model="disp.nomc" class='form-control'>
        </div>

        <div class="form-group">
            <label for="phonee" style='font-weight:bold;'>Telephone</label>
            <input type="text" id="phonee" v-model="disp.phone" class='form-control'>
        </div>

        <div class="form-group">
            <label for="userr" style='font-weight:bold;'>User</label>
            <input type="text" id="userr" v-model="disp.iden" class='form-control'>
        </div>

        <div class="form-group">
            <label for="passs" style='font-weight:bold;'>Login</label>
            <input type="text" id="passs" v-model="disp.pass" class='form-control'>
        </div>

        <div class="form-group">
            <label for="datee" style='font-weight:bold;'>Date d'èxpiration</label>
            <input type="date" id="datee" v-model="disp.daten" class='form-control'>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" @click="updateVendeur" class="btn btn-success" data-dismiss="modal">Modifier</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Vendeur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="name" style='font-weight:bold;'>Nom</label>
            <input type="text" id="name" v-model="dataAdd.nomc" class='form-control' placeholder="Nom">
        </div>

        <div class="form-group">
            <label for="phone" style='font-weight:bold;'>Telephone</label>
            <input type="text" id="phone" v-model="dataAdd.phone" class='form-control' placeholder="Telephone">
        </div>

        <div class="form-group">
            <label for="user" style='font-weight:bold;'>User</label>
            <input type="text" id="user" v-model="dataAdd.iden" class='form-control' placeholder="User">
        </div>

        <div class="form-group">
            <label for="login" style='font-weight:bold;'>Login</label>
            <input type="text" id="login" v-model="dataAdd.pass" class='form-control' placeholder="Login">
        </div>

        <div class="form-group">
            <label for="date" style='font-weight:bold;'>Date d'expiration</label>
            <input type="date" id="date" v-model="dataAdd.daten" class='form-control' placeholder="Date d'expiration">
        </div>

        <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usines</label>
    <select v-model="dataAdd.idu" class="form-control" id="exampleFormControlSelect1">
      <option v-for="us in usine" :key="us.idu" :value="us.idu"> {{ us.nomu }} </option>
    </select>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" @click="addVendeur" class="btn btn-primary" data-dismiss="modal">Ajouter</button>
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
               idc : '',
           },
           vendeurs : [],
           load : false,
           datashow : [],
           clent : [],
           dataAdd : {
               nomc : '',
               phone : '',
               iden : '',
               pass : '',
               daten : '',
               idu : '',
           }
        }
    },
    methods : {
       async generateVendeur()
       {
           const res = await this.callApi('POST','data/getVendeurByidu',this.dataEntry)
           if(res.status === 200)
           {
             this.vendeurs = res.data
           }
       },
       async generateVendeurById()
       {
           const res = await this.callApi('POST','data/getVendeurById',this.dataEntry)
           if(res.status === 200)
           {
               this.load = true
               this.datashow = res.data
           }
           const res1 = await this.callApi('POST','data/getClientByIdu',this.dataEntry)
           if(res1.status === 200)
           {
               this.clent = res1.data
           }
       },
       async delClient()
       {
          const res = await this.callApi('POST','data/deleteClientFromVendeur',this.dataEntry)
          if(res.status === 200)
          {
              this.statu('Opèration èffectuè','success')
          }
       },
       async AddClient()
       {
           const res = await this.callApi('POST','data/addClientForVendeur',this.dataEntry)
           if(res.status === 200)
           {
              if(res.data == 'no')
              {
                  this.statu('Client dèja oriontè','error')
              }else{
                  this.statu('Opèration èffectuè','success')
              }
           }
       },
       async disconnecte()
       {
           const res = await this.callApi('POST','data/disconnecteVendeur',this.dataEntry)
           if(res.status === 200)
           {
               this.statu('Opèration èffectuè','success')
           }
       },
       async deleteVenduer()
       {
           const res = await this.callApi('POST','data/deleteVendeur',this.dataEntry)
           if(res.status === 200)
           {
                for (let i = 0; i < this.vendeurs.length; i++) {
             
             if(this.vendeurs[i].idv == this.dataEntry.idv)
             {
                 this.vendeurs.splice(i,1);
             }
               
           }
           this.load = false
           this.statu('Opèration èffectuè','success')
           }
       },
       async updateVendeur()
       {
           const res = await this.callApi('POST','data/updateVendeur',this.datashow)
           if(res.status === 200)
           {
               if(res.data == 'no')
               {
                   this.statu('Telephone dèja exist','error')
               }else{
                   this.statu('Opèration èffectuè')
               }
           }
       },
       async addVendeur()
       {
          const res = await this.callApi('POST','data/addVendeur',this.dataAdd)
          if(res.status === 200)
          {
              this.statu('Opèration èffectuè','success')
          }
       }
    }
}
</script>