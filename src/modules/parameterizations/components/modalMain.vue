<template>
    <div class="px-5">
        <p class="ms-3 f-16 f-medium">{{ inputName }}</p>
        <el-input v-model="input" placeholder="Nombre" class="mb-3 h-36px" />
        <slot></slot>
        <div class="text-center position-relative">
            <div class="ms-4 mb-1 d-middle">
                <p class="f-semibold f-16">Imagen</p><span class="f-14 ms-1 f-light">(Formato PNG, JPG)</span>
            </div>
            <el-tooltip content="Añadir imagen" placement="bottom" effect="light" >
                <el-upload
                class="avatar-uploader w-147px mx-auto rounded-3"
                action="https://run.mocky.io/v3/9d059bf9-4660-45f2-925d-ce80ad6c4d15"
                list-type="picture-card"
                >
                    <i class="icon-add-square"></i>
                </el-upload>
                <div class="position-absolute">
                    <img :src="dialogImageUrl" alt="Image url" />
                </div>
            </el-tooltip>
            <p class="f-13 f-light text-gray-clear mt-2">Tamaño mín. 100 * 100 px, relación de aspecto 1:1</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    input:{
        type: String
    },
    inputName:{
        type: String,
        default: 'Tipo de restaurante'
    }
})

const input = ref(props.input)
const dialogImageUrl = ref()

</script>

<style lang="scss" scoped>

</style>