<template>
    <div class="d-flex overflow-auto hidden-scroll pe-2 w-100">
        <div class="w-50 overflow-auto hidden-scroll wm-420px pb-5" style="border-right: 2px solid #ede8e8;">
            <orderMiddleInformation 
            :state="informationState" 
            :dataInfoUser="infoOrderUser" 
            :dataInfoDelivery="infoDeliveryR"
            :reloadDeliveryTwo="reloadDeliveryOne"
            :collectDetail="collectDetail"
            :buttonAction="buttonActionConfirmTranfer"
            :instructions="instructionsR"
            :getStatusOrderHistory="getHistoryDataOrder"
        />
        </div>
        <div class="w-50 py-2 px-5 h-100 overflow-auto hidden-scroll wm-420px">
            <productosOrdenesComida :products="informationProducts" />
        </div>
    </div>
</template>

<script setup>
import orderMiddleInformation from '../partials/orderMiddleInformation.vue';
import productosOrdenesComida from '../partials/productosOrdenesComida.vue';

function caja(a){
    console.log('caja',a);
}

let props = defineProps({
    informationState:{
        type: Object,
        required: false,
        default: () => {}
    },
    informationProducts:{
        type: Array,
        required: false,
        default: () => []
    },
    infoOrderUser:{
        type: Object,
        required: false,
        default: () => {}
    },
    infoDeliveryR:{
        type: Object,
        required: false,
        default: () => {}
    },
    reloadDeliveryOne:{
        type: Function,
    },
    collectDetail:{
        type: Object,
        required: false,
        default: () => {}
    },
    buttonActionConfirmTranfer:{
        type: Function,
    },
    instructionsR:{
        type: Object,
    },
    getHistoryDataOrder:{
        type: Array
    }
})


</script>

<style lang="scss" scoped>

</style>