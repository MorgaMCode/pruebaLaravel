<template>
    
    
    <div :id="idi" class="p-3">
        <div class="d-middle gap-3 mb-2">
            <div class="d-middle-center wh-32 rounded-circle" style="background-color: #612AD5;">
                <i class="icon-orders-outline text-black f-25" />
            </div>
            <p class="f-medium f-16">Detalle del cobro</p>
        </div>
        <div class="ms-5">
            <div  :key="i" class="d-middle-bt mb-2">
                <p class="f-light f-14"> Productos({{ infoDetail?.cantidadProductos }})</p>
                <p class="f-medium f-14">
                    <span v-if="detalle?.producto === 'Descuento promo'" >
                        -
                    </span>
                    <span v-if="detalle?.precio !== 'Gratis'" >
                        $ 
                    </span>
                    {{ infoDetail?.valorProductos }}
                </p>
            </div>
                <div class="d-middle-bt mb-3">
                    <p class="f-light f-14">Toppings</p>
                    <p class="f-medium f-14">
                        $ {{ infoDetail.valorToppings }}
                    </p>
            </div>
            <div class="d-middle-bt mb-3">
                <p class="f-light f-14">Descuento Promo</p>
                <p class="f-medium f-14">
                    {{ infoDetail.descuentoPromo }}
                </p>
            </div>
            <div class="d-middle-bt mb-3">
                <p class="f-light f-14">Domicilio</p>
                <p class="f-medium f-14">
                    {{ infoDetail.valorDomicilio }}
                </p>
            </div>
            <div class="my-2" style="border-top: 1px solid #e1e1e1;" />
            <div class="d-middle-bt mb-3">
                <p class="f-light f-14">Total</p>
                <p class="f-medium f-14">
                    {{ infoDetail.valorFinal }}
                </p>
            </div>
        </div>
        <div  class="d-middle gap-3 mb-3" v-if="infoDetail.formaPago !== 2">
            <div class="d-middle-center rounded-circle wh-32" style="background-color: #C2E4DA;">
                <i class="f-25" :class="metodoDePago[infoDetail?.formaPago-1]?.icon" style="color: #50C3A2" />
            </div>
            <p class="f-medium f-16">{{ metodoDePago[infoDetail?.formaPago-1]?.pago }}</p>
        </div>
        <div class="d-flex gap-3" v-else>
            <img src="/img/emptyState/emptyBasket.png" alt="transferencia" class="wh-32" />
            <div>
                <p class="f-medium f-16">transferencia</p>
                <p class="f-light f-14">{{ infoDetail.tranferencia?.banco }} - {{ infoDetail.tranferencia?.cuentaTipo }}</p>
                <p class="f-14">{{infoDetail.tranferencia?.cuentaNumero}}</p>
            </div>
        </div>
        <div class="d-flex flex-column gap-3 ms-5 mt-3 w-266px">
            <p class="f-medium f-14">Comprobante de pago</p>
           
            <img :src="infoDetail.tranferencia?.imagen"  v-if="infoDetail.tranferencia?.tranferenciaArchivo !== null "/>
            <div class="d-middle border-orange gap-2 py-2 br-14" v-if="infoDetail.tranferencia?.tranferenciaArchivo === null " >
                <i class="icon-alerta text-orange f-25" />
                <p class="f-light f-12">El cliente aún no ha enviado el comprobante de pago</p>
            </div>
            <!-- sin confirmar -->
            <template v-if="infoDetail.tranferencia?.tranferenciaEstado === 1 && infoDetail.tranferencia?.tranferenciaArchivo !== Null ">
                <button class="btn bg-general text-white" @click="openModalConfirmarTransferencia"  ><p class="f-medium f-14">Confirmar transferencia</p></button>
                <div class="border-red text-center br-8 py-2 cr-pointer" style="background-color: #FFF4F3;" @click="openModalRechazarTransferencia"  >
                    <p class="f-medium text-red f-14">Rechazar transferencia</p>
                </div>
            </template>
                
            <!-- confirmada -->
            <template  v-if="infoDetail.tranferencia?.tranferenciaEstado === 2 ">
                <div class="d-flex gap-2 p-3 br-14 border-green-clear" >
                    <div class="d-middle-center wh-18">
                        <i class="f-24 icon-verify text-green-clear"  />
                    </div>
                    <div>
                        <p class="f-medium f-12"> Confirmado : <span class="f-light"> {{ infoDetail.tranferencia?.tranferenciaConfirmadaFecha }}  </span></p>
                        <p class="f-medium f-14">{{ infoDetail.tranferencia?.userTranferencia }}</p>
                    </div>
                </div>
            </template>
            <!-- rechazada  -->
            <template  v-if="infoDetail.tranferencia?.tranferenciaEstado === 3 ">
                <div class="d-flex gap-2 p-3 br-14 border-red" >
                    <div class="d-middle-center wh-18">
                        <i class="f-24 icon-close text-red  "  />
                    </div>
                    <div>
                        <p class="f-medium f-12">Rechazado: <span class="f-light"> {{ infoDetail.tranferencia?.tranferenciaConfirmadaFecha }}  </span></p>
                        <p class="f-medium f-14">{{ infoDetail.tranferencia?.userTranferencia }}</p>
                    </div>
                </div>
            </template>


        </div>
    </div>
    <modal ref="refModalConfirmarTransferencia" :modal-width="401" modal-title="Confirmar transferencia" action="Confirmar"  @buttonAction="envioCobro(2)">
        <div class="px-5 py-4">
            <p class="text-grey-light f-15">¿Confirmar que el cliente realizó la transferencia de pago de la orden?</p>
        </div>
    </modal>
    <modal ref="refModalRechazarTransferencia" :modal-width="401" modal-title="Rechazar transferencia" action="Rechazar" @buttonAction="envioCobro(3)">
        <div>
            <p class="text-grey-light f-15 px-5 py-4">¿Rechazar la transferencia de pago de la orden?</p>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref, computed } from 'vue';

const refModalConfirmarTransferencia = ref()
const refModalRechazarTransferencia = ref()
let props = defineProps({
    idi:{
        type: String,
        required: false,
        default: ''
    },
    infoDetail:{
        type: Object,
        required: false,
        default: () => {}
    },
    envioCobro:{
        type: Function
    }
})



const metodoDePago = ref([
    { icon: 'icon-bill', pago: 'Pago en efectivo' },
    { icon: 'icon-dataphone', pago: 'Pago por datafono' },
    { icon: 'icon-online-payment', pago: 'Pago en linea' },
    
])




let precioAcumulado = computed(() => {
    let precioAcumulado = null
    detalleDeCobroPrecio.value.forEach((element) => {
        if(element.producto !== 'Descuento promo' && element.precio !== 'Gratis' ){
            precioAcumulado += Number(element.precio)
        }else if(element.producto.includes('Descuento promo')){
            precioAcumulado -= Number(element.precio)
        }
    })
    return precioAcumulado
})




function openModalRechazarTransferencia(){
    refModalRechazarTransferencia.value.open()
}

function openModalConfirmarTransferencia(){
    refModalConfirmarTransferencia.value.open()
}

</script>

<style lang="scss" scoped>

</style>