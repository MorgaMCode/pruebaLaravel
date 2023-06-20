<template>
    <div class="px-5 py-5 w-100">
        <div class="d-middle gap-2">
            <el-tooltip content="Regresar" placement="bottom" effect="light">
                <div class="f-25 icon-hover-blue rounded-circle cr-pointer wh-32 d-middle-center" @click="backRouter">
                    <i class="icon-chevron-left" />
                </div>
            </el-tooltip>
            <h1 class="f-20 f-bold mb-0">{{ route.name == routeName ? 'Crear' : 'Editar' }} sección</h1>
        </div>
        <div class="mt-5" style="margin-left: 40px; max-width: 570px;">
            <Form @submit="formTermsAndConditions" id="CreateForm" >
                <h5 class="mb-0 f-16 f-medium ps-3 pb-1">Titulo de la sección</h5>
                <Field v-slot="{ field, errorMessage }" name="nombre" label="Nombre" rules="required|max:40" >
                    <el-input
                        v-model="title"
                        placeholder="Escribe un titulo"
                        maxlength="40"
                        v-bind="field"
                    />
                    <p class="f-14 text-red">{{ errorMessage }}</p>
                </Field>
                <h5 class="mb-0 f-medium f-16 ps-3 mt-4 pb-1">Descripción</h5>
                <Field v-slot="{ field, errorMessage }" name="descripcion" label="Descripcion" rules="required|max:40" >
                    <el-input
                        v-model="descripcion"
                        placeholder="Escribir una descripción"
                        v-bind="field"
                        type="textarea" :rows="4"
                    />
                    <p class="f-14 text-red">{{ errorMessage }}</p>
                </Field>
            </Form>
            <div class="d-middle-end gap-3 mt-4">
                <button-action  button-content="Cerrar" text-color="text-black" bg="bg-white" borderColor="border-blue-lightest" @open="close" />
                <button-action :button-content="route.name == routeName ? 'Crear' : 'Guardar'" type-button="submit" send-form="CreateForm" />
            </div>
        </div>
    </div>
</template>

<script setup>
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import { useRoute, useRouter } from 'vue-router';
import { Form, Field } from 'vee-validate'

let route = useRoute()
let router = useRouter()
let title = ''
let descripcion= ''

let routeName = 'parameterization.faqsClients.termsAndConditions.create'

function backRouter(){
    router.push({ name: 'parameterization.faqsClients.termsAndConditions' })
}
function close(){
    router.push({ name: 'parameterization.faqsClients.termsAndConditions' })
}

function formTermsAndConditions(){
    console.log('Este es el boton de terminos y condiciones');
}

</script>

<style lang="scss" scoped>

</style>