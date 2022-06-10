<style>
label {
    font-weight: bold;
}
</style>
<template>
    <div>
        <Dialog header="Create New Subscribe" v-model:visible="isCreate" :style="{width: '50vw'}" :modal="true" :draggable="false">
            <SubscribeForm :data="data" :createSubscribe="createSubscribe" />
        </Dialog>
        <UpdateSubscribe :data="data" :subscribe_id="subscribe_id" :isEdit="isEdit" :isMassEdit="isMassEdit" :selectedSubscribe="selectedSubscribe" :close="close" :updateSubscribe="updateSubscribe" />

        <DataTable :value="subscribes" v-model:filters="filter" :paginator="true" :rows="10"
            v-model:selection="selectedSubscribe" :scrollable="true"  :rowHover="true" showGridlines
            :globalFilterFields="['msisdn','shortcode','keyword','status','charge_price','service']">
            <template #header>
                <div class="table-header">
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText v-model="filter['global'].value" placeholder="Search" />
                    </span>
                    <div style="float: right">
                        <button type="button" class="btn btn-success" @click="isEdit = true; isMassEdit = true;" :disabled="!selectedSubscribe || !selectedSubscribe.length">Mass Update</button> &nbsp; &nbsp;
                        <button type="button" class="btn btn-primary" @click="isCreate = true">+ Add</button>
                    </div>
                </div>
            </template>
            <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>
            <Column field="msisdn" header="Msisdn" :sortable="true" ></Column>
            <Column field="shortcode" header="Shortcode" :sortable="true" ></Column>
            <Column field="keyword" header="Keyword" :sortable="true" ></Column>
            <Column field="status" header="Status" :sortable="true" ></Column>
            <Column field="charge_price" header="Charge Price" dataType="numeric" :sortable="true" >
                <template #body="slotprops">
                    {{ slotprops.data.charge_price.toFixed(2)}}
                </template>
            </Column>
            <Column field="service" header="Service" :sortable="true" ></Column>
            <Column header="Action" headerStyle="width: 4rem; text-align: center" bodyStyle="text-align: center; overflow: visible">
                <template #body="slotprops">
                    <button type="button" class="btn btn-primary">
                        <i class="pi pi-pencil" @click="getSubscribeById(slotprops.data.id)" />
                    </button>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
    import axios from 'axios';
    import SubscribeForm from './SubscribeForm.vue';
    import UpdateSubscribe from './UpdateSubscribe.vue';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import ColumnGroup from 'primevue/columngroup';
    import Row from 'primevue/row';
    import Dialog from 'primevue/dialog';
    import InputText from 'primevue/inputtext';
    import {FilterMatchMode} from 'primevue/api';

    export default {
        components: {
            SubscribeForm,
            UpdateSubscribe,
            DataTable,
            Dialog,
            Column,
            ColumnGroup,
            Row,
            InputText,
        },
        data() {
            return {
                subscribe_id: null,
                isCreate: false,
                isEdit: false,
                isMassEdit: false,
                subscribes: [],
                selectedSubscribe: null,
                filter: {},
                data: {
                    msisdn      : "",
                    shortcode   : "1111",
                    keyword     : "AA",
                    status      : "active",
                    charge_price: 0,
                    service     : "",
                }
            }
        },
        created() {
            this.initFilters();
        },
        mounted() {
            this.getSubscribes();

        },
        methods: {
            createSubscribe() {
                axios.post('http://localhost:8000/create', this.data)
                    .then( (res) => {
                        this.isCreate = false;
                        this.getSubscribes();
                    } )
                    .catch( (err) => {
                        console.log(err)
                    });
            },
            getSubscribes() {
                axios.get('http://localhost:8000/subscribe')
                    .then( (res) => {
                        this.subscribes = res.data;
                    })
                    .catch( (err) => {
                        console.log(err)
                    })
            },
            getSubscribeById(id) {
                this.subscribe_id = id;
                axios.get('http://localhost:8000/subscribe/' + id)
                    .then( (res) => {
                        this.data = res.data;
                        this.isEdit = true;
                    })
                    .catch( (err) => {
                        console.log(err)
                    })
            },
            updateSubscribe() {
                if (this.isMassEdit == false ) {
                    axios.post('http://localhost:8000/subscribe/' + this.subscribe_id, this.data)
                    .then( (res) => {
                        this.close();
                        this.getSubscribes();
                    })
                    .catch( (err) => {
                        console.log(err)
                    })
                }
                else {
                    axios.post('http://localhost:8000/masssubscribe', this.selectedSubscribe)
                        .then( (res) => {
                            this.close();
                        })
                        .catch( (err) => {
                            console.log(err)
                        })
                }

            },
            close() {
                this.isEdit = false;
                this.isMassEdit = false;
                this.reset();
            },
            reset() {
                this.data.msisdn       = "";
                this.data.shortcode    = "1111";
                this.data.keyword      = "AA";
                this.data.status       = "active";
                this.data.charge_price = 0;
                this.data.service      = "";

            },
            initFilters() {
                this.filter = {
                    'global' : {value: null, matchMode: FilterMatchMode.CONTAINS},
                }
            }
        }
    }
</script>