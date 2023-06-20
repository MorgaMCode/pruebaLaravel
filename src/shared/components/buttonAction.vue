<template>
    <button :form="sendForm" :type="typeButton" :disabled="attribute" id="botoncito" class="h-36px rounded-3 f-14" :class="width, opacidad, bg, textColor, textColor, borderColor, classDinamic" @click="$emit('open')">
            {{ buttonContent }}
    </button>
</template>

<script setup>

const props = defineProps({
    buttonContent: {
        type: String,
        default: 'Crear'
    },
    width: {
        type: String,
        default: 'w-140px'
    },
    opacidad: {
        type: Object,
    },
    attribute: {
        type: Boolean,
        default: false
    },
    bg: {
        type: String,
        default: 'bg-general'
    },
    textColor: {
        type: String,
        default: 'text-white'
    },
    borderColor: {
        type: String,
        default: 'border-0'
    },
    typeButton: {
        type: String,
        default: 'button'
    },
    classDinamic: {
        type: String,
        required: false,
    },
    sendForm: {
        type: String
    }
})


</script>

<style lang="scss" scoped>

</style>