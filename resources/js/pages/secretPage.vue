<template>
    <div class="container">
        <div class="row">
            <div style="margin-top:200px" class="col-md-12">
                <div class="form-group">
                    <label for="code">Code secrète</label>
                    <input
                        type="text"
                        @keyup="change"
                        v-model="entry.secret"
                        id="code"
                        class="form-control"
                        placeholder="Code secrète"
                        @keypress.enter="handle"
                    />
                </div>

                <button  @click="handle" :disabled="tog" class="btn btn-primary">
                    vèrifier
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            entry : {
                secret: "",
                },
            tog: true
        };
    },
    methods: {
        change() {
            if (this.entry.secret.length === 0) {
                this.tog = true;
            } else if (this.entry.secret.length <= 3) {
                this.tog = true;
            } else {
                this.tog = false;
            }
        },
        async handle()
        {
            this.tog = true

            const res = await this.callApi('POST','check',this.entry)
            
            if(res.status === 200)
            {
                if(res.data == 'no')
                {
                this.statu('Code secret incorrecte','error')
                setInterval(() => {
                    this.tog = false
                }, 2000);

                }else{
                this.statu('Opèration èffectuè','success')
                 setInterval(() => {
                    this.tog = false
                }, 2000);
                location.reload();
                }
            }

        }
    }
};
</script>
