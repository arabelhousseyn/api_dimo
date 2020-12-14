<template>
    <div>
        <header-comp />
        <router-view v-if="!load" :admins="admins" :usine="usine"></router-view>
        <div style='margin-top:20px;' class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style='text-align:center;' class="cont">
                    <button @click="refresh" class='btn btn-success'>actualiser</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import headerComp from "../components/headerComp.vue";
export default {
    data() {
        return {
            usine: [],
            admins : [],
            load : false
        };
    },
    components: {
        headerComp
    },
   
         async created() {
        const res = await this.callApi("GET", "data/getAllUsine/");
        if (res.status === 200) {
            this.usine = res.data;
        }
        const res1 = await this.callApi('GET','data/getAllAdmins/')
        if(res1.status ===200)
        {
            this.admins = res1.data
        }
    },
    methods : {
        refresh()
        {
            this.load = true

            setInterval(() => {
                this.load = false
            }, 1000);
            location.reload();
        }
    }
};
</script>
