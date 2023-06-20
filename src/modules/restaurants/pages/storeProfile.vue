<template>
    <div class="px-5 pb-5 h-100 overflow-auto hidden-scroll">
        <h1 class="f-20 f-semibold">perfil de la tienda</h1>
        <div v-if="Object.keys(informationStoreProfile).length" class="mx-3 mt-4">
            <h2 class="f-bold f-28">{{ informationStoreProfile.nombre }}</h2>
            <div class="d-middle">
                <i class="icon-restaurant f-25" />
                <p class="f-medium f-20">{{ informationStoreProfile.restaurante }}</p>
            </div>
            <p class="text-whitesmoke f-14">
                {{ informationStoreProfile.descripcion }}
            </p>
            <div class="d-middle mt-3">
                <i class="icon-image f-25" />
                <p class="f-medium f-18">Imagenes</p>
            </div>
            <div v-if="informationStoreProfile.imagenes?.length" class="w-79px h-140px d-middle gap-2">
                <template v-for="(image, i) in informationStoreProfile.imagenes">
                    <el-image
                        class="h-100 w-100 br-5"
                        :src="image.archivo"
                        :zoom-rate="1.2"
                        :preview-src-list="informationStoreProfile.imagenes.map((element) => element.archivo)"
                        :initial-index="0"
                        :preview-teleported="true"
                        fit="cover"
                    />
                </template>
            </div>
            <div v-else class="w-100 h-140px d-middle-center">
                <p class="text-whitesmoke f-14">Imagenes no disponibles</p>
            </div>
            <div class="d-middle mt-4">
                <i class="icon-video f-25" />
                <p class="f-medium f-18">Videos</p>
            </div>
            <div v-if="informationStoreProfile.videos?.length" v-for="(video, i) in informationStoreProfile.videos" :key="i" class="d-flex cr-pointer w-79px h-140px" @click="openVideoGif(i)">
                <el-image
                    :src="video.preview"
                    class="w-100 h-100 br-5"
                    fit="cover"
                />
            </div>
            <div v-else class="w-100 h-140px d-middle-center">
                <p class="text-whitesmoke f-14">Videos no disponibles</p>
            </div>
        </div>
        <div v-else class="d-middle j-center flex-column gap-3 w-100 h-100">
            <img src="/img/emptyState/woProfile.png" alt="" class="wh-200">
            <p class="text-whitesmoke f-14">Esta tienda aún no tiene un perfil creado</p>
        </div>
    </div>
    <modal ref="openModalVideo" modal-title="Videos" :modal-width="800" :see-buttons-bottom="false" @closeModal="closeModal">
        <div class="p-4 h-500px">
            <video
                :src="informationStoreProfile.videos[indiceVideo].archivo"
                :autoplay="autoPayVideo"
                :muted="videoMuted"
                class="w-100 h-100"
                id="myVideo"
                controls
            />
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

let route = useRoute()

const openModalVideo = ref()

onMounted(() => {
    getDatasStoreProfile()
})

const informationStoreProfile = ref({})
const indiceVideo = ref(null)
let autoPayVideo = false
let videoMuted = true
let videoPaused = false

function openVideoGif(indice){
    indiceVideo.value = indice
    autoPayVideo = true
    videoMuted = false
    openModalVideo.value.open()
}

function closeModal(){
    autoPayVideo = false
    videoMuted = true
}

async function getDatasStoreProfile(){
    let getStoreProfile = await axios.get(`api/restaurantes/${route.params.id}/tiendas/${route.params.idStore}/perfil`)
    informationStoreProfile.value = getStoreProfile.data?.data ?? {}
}

</script>

<style lang="scss" scoped>

</style>