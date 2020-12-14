<template>
    <section id='adminstrateur'>
     <div class="container">
         <div class="row">
             <div class="col-md-12">
               <button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal1">Ajouter</button>

               <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usines</label>
    <select  v-model="dataEntry.idu"   class="form-control" id="exampleFormControlSelect1">
        <option selected disabled>Choisir</option>
      <option v-for="us in usine" :key="us.idu" :value="us.idu" >{{us.nomu}}</option>
    </select>
  </div>

                 <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Les administrateurs</label>
    <select @change="Changestate" v-model="dataEntry.ids"   class="form-control" id="exampleFormControlSelect1">
        <option selected disabled>Choisir</option>
      <option v-for="admin in admins" v-if="dataEntry.idu == admin.idu[0].idu" :key="admin.ids" :value="admin.ids" >{{admin.noms}}</option>
    </select>
  </div>
  <div v-if="load" id="data">
   <div style='text-align:center;' v-for="show in dataShow" :key="show.ids" class="box">
       <h5><span style='font-weight:bold;'>Usine</span>  : {{ show.idu[0].nomu }} </h5>
      <h5><span style='font-weight:bold;'>Nom</span>  : {{ show.noms }} </h5>
      <h5><span style='font-weight:bold;'>Telephone</span>  : {{ show.phone }} </h5>
      <h5><span style='font-weight:bold;'>User</span>  : {{ show.iden }} </h5>
      <h5><span style='font-weight:bold;'>Login</span>  : {{ show.pass }} </h5>
      <h5  v-if="show.active == 'true'" style='color:green;'> connectè 
        <br>
        <button @click="disconnecte" class='btn btn-danger'>dèconnectè</button>
      </h5>
      <h5 v-if="show.active == 'false'" style='color:red;'> dèconnectè </h5>

      <h5 v-if="show.type == '0'" style='color:green;'> Administrateur principale </h5>
      <h5 v-if="show.type == '1'" style='color:yellow;'> Sous Administrateur </h5>

      <h5> èxpiration : {{ show.daten }} </h5>

      <div v-if="show.type == '1'" class="op">
      <div class="form-group">
    <label for="exampleFormControlSelect2" style='font-weight:bold;'>Liste des vendeur</label>
    <select v-model="dataEntry.idv" class="form-control" id="exampleFormControlSelect2">
      <option v-for="v in vendeurs"  :key="v.idv"  :value="v.idv" >{{ v.nomc }}</option>
    </select>
  </div>
  <button @click="addVendeur" class='btn btn-primary'>Ajouter Vendeur</button>
       
       <div class="form-group">
    <label for="exampleFormControlSelect3" style='font-weight:bold;'>Liste des vendeur Appartient</label>
    <select v-model="dataEntry.idv" class="form-control" id="exampleFormControlSelect3">
      <option v-for="sha in show.vendeur" :value="sha.idv"  :key="sha.idv" >{{ sha.nomc }}</option>
    </select>
  </div>
  <button @click="delVendeur" class='btn btn-danger'>Supprimer Vendeur</button>
</div>
<div style='margin-top:20px;' class="tog">
<button @click="handleDataDelete(show)" data-toggle="modal" data-target="#exampleModal" class='btn btn-success'>Modifier admin</button>
<button @click="delAdmin" :disabled="load2"  class='btn btn-danger'>Supprimer Admin</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Modifier Administrateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <div class="form-group">
          <label for="name" style='font-weight:bold;'>Nom</label>
          <input type="text" id="name" class='form-control' v-model="dataHandle.noms">
        </div>

        <div class="form-group">
          <label for="phone" style='font-weight:bold;'>Telephone</label>
          <input type="text" id="phone" class='form-control' v-model="dataHandle.phone">
        </div>

        <div class="form-group">
          <label for="user" style='font-weight:bold;'>User</label>
          <input type="text" id="user" class='form-control' v-model="dataHandle.iden">
        </div>

        <div class="form-group">
          <label for="pass" style='font-weight:bold;'>Login</label>
          <input type="text" id="pass" class='form-control' v-model="dataHandle.pass">
        </div>

        <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Type</label>
    <select v-model="dataHandle.type" class="form-control" id="exampleFormControlSelect1">
      <option value="0">Administrateur principale</option>
      <option value="1">Sous administrateur</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usine</label>
    <select v-model="dataEntry.idu" class="form-control" id="exampleFormControlSelect1">
      <option v-for="us in usine" :key="us.idu" :value="us.idu" > {{ us.nomu }} </option>
    </select>
  </div>
  <div class="form-group">
    <input type="date"  class='form-control' v-model="dataHandle.daten">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button :disabled="load3" data-dismiss="modal"  @click="updateAdmin" type="button" class="btn btn-success">Modifier</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Administrateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="namee" style='font-weight:bold;'>Nom</label>
          <input type="text" id="namee" v-model="dataAdd.noms" placeholder="Nom" class='form-control'>
        </div>

        <div class="form-group">
          <label for="phonee" style='font-weight:bold;'>Telephone</label>
          <input type="text" id="phonee" v-model="dataAdd.phone" placeholder="Telephone" class='form-control'>
        </div>

        <div class="form-group">
          <label for="idenn" style='font-weight:bold;'>User</label>
          <input type="text" id="idenn" v-model="dataAdd.iden" placeholder="User" class='form-control'>
        </div>

        <div class="form-group">
          <label for="passs" style='font-weight:bold;'>Pass</label>
          <input type="text" id="passs" v-model="dataAdd.pass" placeholder="Pass" class='form-control'>
        </div>

        <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Type</label>
    <select v-model="dataAdd.type" class="form-control" id="exampleFormControlSelect1">
      <option value="0">Administrateur principale</option>
      <option value="1">Sous administrateur</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-weight:bold;'>Usine</label>
    <select v-model="dataAdd.idu" class="form-control" id="exampleFormControlSelect1">
      <option v-for="us in usine" :key="us.idu" :value="us.idu"> {{ us.nomu }} </option>
    </select>
  </div>

  <div class="form-group">
    <label for="datee" style='font-weight:bold;'>Date</label>
    <input type="date"  id="datee" class='form-control' v-model="dataAdd.daten">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>
        <button type="button" @click="addAdmin" class="btn btn-primary" data-dismiss="modal">Ajouter</button>
      </div>
    </div>
  </div>
</div>
    </section>
</template>
<script>
export default {
    props : ['admins','usine'],
    data()
    {
        return{
           dataShow : [],
           dataEntry : {
               ids : '',
               idv : '',
               idu : ''
           },
           load : false,
           vendeurs : [],
           load2 : false,
           dataHandle: [],
           load3 : false,
           dataAdd :{
             noms : '',
             phone : '',
             iden : '',
             pass : '',
             daten : '',
             idu : '',
             type : '',

           }
           
        }
    },
    methods : {
       async Changestate()
        {
            const res = await this.callApi('POST','data/getAdminById',this.dataEntry)
            if(res.status === 200)
            {
             this.load = true
             this.dataShow = res.data
            }

            const res2 = await this.callApi('POST','data/getVendeurByUsine',res.data)
            if(res2.status === 200)
            {
                this.vendeurs = res2.data
            }
        },
        async addVendeur()
        {
            let data = new FormData();
            data.append('idv',this.dataEntry.idv)
            data.append('ids',this.dataShow[0].ids)
            const res = await this.callApi('POST','data/addVendeurForAdmin',data)
            if(res.status === 200)
            {
                if(res.data == 'no')
                {
                    this.statu('vendeur dèja ajouter pour ce admin','error')
                }else{
                    this.statu('Opèration èffectuè','success')
                }
            }
        },
        async delVendeur()
        {
         let data = new FormData();
            data.append('idv',this.dataEntry.idv)
            data.append('ids',this.dataShow[0].ids)
            const res = await this.callApi('POST','data/delVendeurForAdmin',data)
            if(res.status === 200)
            {
                    this.statu('Opèration èffectuè','success')
            }
        },
        async delAdmin()
        {
            this.load2 = true
            const res = await this.callApi('POST','data/deleteAdmin',this.dataEntry)
            if(res.status === 200)
            {
                console.log(res)
                this.statu('Opèration èffectuè','success')
                
                for (let i = 0; i < this.admins.length; i++) {
                    if(this.admins[i].ids == this.dataEntry.ids)
                    {
                        this.admins.splice(i,1);
                        this.load = false
                        this.load2 = false
                    }
                    
                }
            
            }
        },
        handleDataDelete(obj)
        {
             this.dataHandle = obj
        },
        async disconnecte()
        {
           const res = await this.callApi('POST','data/disconnecte',this.dataEntry)
           if(res.status === 200)
           {
             this.statu('Opèration èffectuè','success')
           }
        },
        async updateAdmin()
        {
          const data = new FormData();
          data.append('ids',this.dataHandle.ids);
          data.append('noms',this.dataHandle.noms);
          data.append('phone',this.dataHandle.phone);
          data.append('iden',this.dataHandle.iden);
          data.append('pass',this.dataHandle.pass);
          data.append('idu',this.dataEntry.idu);
          data.append('noms',this.dataHandle.noms);
          data.append('daten',this.dataHandle.daten);
          data.append('type',this.dataHandle.type);
            const res = await this.callApi('POST','data/updateAdmin',data)
            if(res.status === 200)
            {
              if(res.data == 'no')
              {
                this.statu('Numèorde telephone dèja exist','error')
              }else{
                this.statu('Opèration èffectuè','success');
              }
            }
        },
        async addAdmin()
        {
          if(this.dataAdd.noms.length === 0 || this.dataAdd.phone.length == 0 || this.dataAdd.iden.length == 0 || 
          this.dataAdd.pass.length == 0 || this.dataAdd.daten.length == 0 || this.dataAdd.idu.length == 0
          || this.dataAdd.type == 0)
          {
        this.statu('entrer vous tous les information','error')
          }else{
const res = await this.callApi('POST','data/addAdmin',this.dataAdd)
          if(res.status === 200)
          {
            if(res.data == 'no')
            {
                this.statu('numèro de telephone dèja exist','error')
            }else{
this.statu('Opèration èffectuè','success')
this.admins.push(res.data)
            }
          }
          }
        }
        

    },

    
}
</script>