<template>
    <section id="usine">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#exampleModal"
                    >
                        Ajouter
                    </button>
                    <div class="form-group">
                        <div class="form-group">
                            <label
                                for="exampleFormControlSelect1"
                                style="font-weight:bold;"
                                >Usines</label
                            >
                            <select
                                v-model="dataEntry.idc"
                                class="form-control select"
                                id="exampleFormControlSelect1"
                                @change="changeState"
                            >
                                <option selected disabled>Choisir</option>
                                <option
                                    v-for="u in usine"
                                    :key="u.idu"
                                    :value="u.idu"
                                >
                                    {{ u.nomu }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <button
                        data-toggle="modal"
                        data-target="#exampleModal1"
                        @click="changeU"
                        :disabled="load"
                        class="btn btn-success"
                    >
                        modifier
                    </button>
                    <button
                        data-toggle="modal"
                        data-target="#exampleModal2"
                        @click="changeU"
                        :disabled="load"
                        class="btn btn-danger"
                    >
                        supprimer
                    </button>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            style="font-weight:bold;"
                            class="modal-title"
                            id="exampleModalLabel"
                        >
                            Ajouter Usine
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nameu" style="font-weight:bold;"
                                >Nom usine</label
                            >
                            <input
                                type="text"
                                id="nameu"
                                placeholder="Nom Usine"
                                v-model="dataInsert.name"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            fermer
                        </button>
                        <button
                            @click="insertU"
                            type="button"
                            class="btn btn-primary"
                        >
                            ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="exampleModal1"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            style="font-weight:bold;"
                            class="modal-title"
                            id="exampleModalLabel"
                        >
                            Modifier Usine
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="up-nameu" style="font-weight:bold;"
                                >Nom usine</label
                            >
                            <input
                                type="text"
                                id="up-nameu"
                                :placeholder="dataEntry.namec"
                                v-model="dataEntry.namec"
                                @keyup="changeStateSecond"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            fermer
                        </button>
                        <button
                            @click="updateU"
                            :disabled="load1"
                            type="button"
                            class="btn btn-success"
                        >
                            Modifier
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="exampleModal2"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            style="font-weight:bold;"
                            class="modal-title"
                            id="exampleModalLabel"
                        >
                            Supprimer Usine
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="font-weight:bold;text-align:center;">
                                Si vous voulez supprimer appuez sur oui sinon
                                sur non
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            non
                        </button>
                        <button
                            @click="delU"
                            data-dismiss="modal"
                            type="button"
                            class="btn btn-success"
                        >
                            oui
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["usine"],
    data() {
        return {
            dataEntry: {
                idc: "",
                namec: ""
            },
            load: true,
            load1: true,
            dataInsert: {
                name: ""
            },
            load2: true
        };
    },
    methods: {
        async changeU() {
            const res = await this.callApi(
                "POST",
                "data/getUsineById",
                this.dataEntry
            );
            if (res.status === 200) {
                this.dataEntry.idc = res.data[0].idu;
                this.dataEntry.namec = res.data[0].nomu;
            }
        },
        async updateU() {
            this.load1 = true;
            const res = await this.callApi(
                "POST",
                "data/updateUsineById",
                this.dataEntry
            );
            if (res.status === 200) {
                setInterval(() => {
                    this.load1 = false;
                }, 2000);
                for (let i = 0; i < this.usine.length; i++) {
                    if (this.usine[i].idu == this.dataEntry.idc) {
                        this.usine[i].nomu = this.dataEntry.namec;
                        break;
                    }
                }
                this.statu("Opèration èffectuè", "success");
            }
        },
        changeState() {
            if (this.dataEntry.idc === "") {
                this.load = true;
            } else {
                this.load = false;
            }
        },
        changeStateSecond() {
            if (this.dataEntry.namec === "") {
                this.load1 = true;
            } else {
                this.load1 = false;
            }
        },
        async insertU() {
            this.load1 = true;
            const res = await this.callApi(
                "POST",
                "data/insertUsine",
                this.dataInsert
            );
            if (res.status === 200) {
                let tmp = 0;
                for (let i = 0; i < this.usine.length; i++) {
                    if (this.usine[i].idu > tmp) {
                        tmp = this.usine[i].idu;
                    }
                }
                let format = {
                    idu: tmp + 1,
                    nomu: this.dataInsert.name
                };

                this.usine.push(format);
                tmp = 0;
                this.dataInsert.name = "";

                this.statu("Opèration èffectuè", "success");
                setInterval(() => {
                    this.load1 = false;
                }, 2000);
            }
        },
        changeStateSecond() {
            if (this.dataEntry.namec === "") {
                this.load1 = true;
            } else {
                this.load1 = false;
            }
        },
        async delU() {
            const res = await this.callApi(
                "POST",
                "data/deleteUsineById",
                this.dataEntry
            );
            if (res.status === 200) {
                this.statu("Opèration èffectuè", "success");
                for (let i = 0; i < this.usine.length; i++) {
                    if (this.usine[i].idu == this.dataEntry.idc) {
                        this.usine.splice(i, 1);
                    }
                }
            }
        }
    }
};
</script>
