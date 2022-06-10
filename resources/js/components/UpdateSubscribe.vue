<template>
    <Dialog v-model:visible="isEdit" :style="{width: '50vw'}" :modal="true" :closable="false" :draggable="false">
        <template #header>
            <span style="font-weight: 700; font-size: 1.25rem">Update Subscribe</span>
            <span></span>
            <span class="pi pi-times" style="position: absolute; right: 5%; cursor:pointer" @click="close()"></span>
        </template>
        <div v-if="isMassEdit == true">
            <Panel :header="'Msisdn - ' +  data.msisdn.toString()" :toggleable="true"
                    v-for="data in selectedSubscribe" :key="data">
                <UpdateSubscribeForm :data="data"  />
            </Panel>
        </div>
        <Panel :header="'Msisdn - ' +  data.msisdn.toString()" :toggleable="false" v-else>
            <UpdateSubscribeForm :data="data" />
        </Panel>
        <br>
        <button type="button" class="btn btn-primary" @click="updateSubscribe()">Update</button>
    </Dialog>

</template>

<script>
    import UpdateSubscribeForm from './UpdateSubscribeForm.vue';
    import Dialog from 'primevue/dialog';
    import Panel from 'primevue/panel';

export default ({
    components: {
        UpdateSubscribeForm,
        Dialog,
        Panel,
    },
    props: {
        subscribe_id: {
            type: Number,
            default: null
        },
        data: {
            type: Object,
            default: {}
        },
        isEdit: {
            type: Boolean,
            default: false,
        },
        isMassEdit: {
            type: Boolean,
            default: false,
        },
        selectedSubscribe: {
            type: Array,
            default: []
        },
        close: Function,
        updateSubscribe: Function,
    },
})
</script>
