<template>
    <div class="br-6 text-center" :class="[seeState(stateContent), showPadding ? 'py-3 px-2' : '']">
        <p class="f-14">{{ stateContent }}</p>
    </div>
</template>

<script setup>

let props = defineProps({
    stateContent:{
        type: String,
        required: false
    },
    showPadding: {
        type: Boolean,
        default: false
    }
})

function seeState(state){
    if(state == undefined)return
    else{
        if(state.includes('Inactivo')) {
            return 'stateGrey'
        }
        else if(state.includes('Nuevo') || state.includes('Reenviado')) {
            return 'stateBlue'
        }
        else if(state.includes('Revisión')) {
            return 'stateYellow'
        }
        else if(state.includes('Rechazado')) {
            return 'stateRed'
        }
        else if(state.includes('Activo')) {
            return 'stateGreen'
        }
        else if(state.includes('Eliminado')) {
            return 'stateLightGrey'
        }
    }
}

</script>

<style lang="scss" scoped>
%decoration{
    padding: 5px 9px;
    border-radius: 6px;
    border: transparent;
}

.stateBlue{
    @extend %decoration;
    background-color: #0052CC33;
    color: var(--blue-state);
}
.stateYellow{
    @extend %decoration;
    background-color: #ffdfb8;
    color: #FF991F;
}
.stateGreen{
    @extend %decoration;
    background-color: #29D88433;
    color: var(--green-clear);
}
.stateRed{
    @extend %decoration;
    background-color: #ffe3df;
    color: var(--red-pill);
}
.stateGrey{
    @extend %decoration;
    background-color: #97A0B033;
    color: var(--whitesmoke);
}
.stateLightGrey{
    @extend %decoration;
    background-color: #DFE4E833;
    color: var(--whitesmoke);
}

</style>