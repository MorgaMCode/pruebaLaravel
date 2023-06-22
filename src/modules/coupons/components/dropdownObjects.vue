<template>
        <div class="br-16 icon-hover-blue" @click="selectedDropdown">
            <el-dropdown class="elDropdown py-1" style="padding: 0px 6px 0px 15px;" trigger="click" :hide-on-click="false" >
                <span class="f-16 d-middle gap-1">
                    {{ data.text }}
                    <div class="w-24px h-20px bg-general rounded-pill d-middle-center">
                        <!-- <p class="text-white f-14 f-light">{{ data }}</p> -->
                    </div>
                    <i class="icon-chevron-down f-20 wh-20 d-middle-center" />
                </span>
                <template #dropdown>
                    <el-dropdown-menu v-for="(information, index) in data.dropdownInformation" :key="index" class="br-8" >
                        <el-dropdown-item class="w-259px px-2 py-0">
                            <div
                                :class="show(information.id) ? 'border-green-clear backgroundDropdown':'border' "
                                class="w-100 br-8 px-2 py-1 d-flex gap-1 cr-pointer backgroundDropdownHover"
                                @click="selected(information.id)"
                            >
                                <i v-if="show(information.id)" class="icon-verify f-25 text-green-clear me-0" />
                                <div v-else class="w-35px h-25px" />
                                <img v-if="information.image" :src="information.image" :alt="`image${information.image}`" class="h-24px w-17px">
                                <p :class="show(information.id) ? 'text-green-clear':'text-grey'" class="f-14 f-medium">{{ information.text }}</p>
                            </div>
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
        </div>
</template>

<script setup>
import buttonAction from '../../../shared/components/buttonAction.vue';
import { ref, computed } from 'vue';

const seeSelected = computed({
    get(){
        return props.modelValue
    },
    set(newValue){
        emit('update:modelValue', newValue)
    }
})

const emit = defineEmits(['update:modelValue'])

function show(id){
    return seeSelected.value.includes(id)
}

const props = defineProps({
    data: {
        type: Object
    },
    modelValue: {
        type: Array
    }
})

function selected(id){
    if(seeSelected.value.includes(id)){
        seeSelected.value = seeSelected.value.filter((e) => e != id)
    }else{
        seeSelected.value.push(id)
    }
}

function selectedDropdown(){
    
}

function seeDropdownSelected(){
    
}

</script>

<style lang="scss" scoped>
.backgroundDropdown{
    background-color: #29D8840D;
}
.backgroundDropdownHover{
    &:hover{
        background-color: #29D8840D;
        cursor: pointer;
    }
}

.elDropdown:has([aria-expanded="true"]){
    background-color: var(--blue-state-lightest) !important;
    border-radius: 16px;
}
</style>