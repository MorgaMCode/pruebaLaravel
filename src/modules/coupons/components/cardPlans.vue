<template>
    <section>
        <div class="d-flex gap-2">
            <img v-if="data.image" :src="data.image" alt="" class="wh-24" />
            <p v-if="data.title" class="f-16 f-bold">{{ data.title }}</p>
        </div>
        <div class="border d-middle-bt text-whitesmoke br-8 ps-2 pe-4 my-2">
            <div v-for="(object, i) in data.objects" :key="i" class="d-flex">
                <i :class="object.icon" class="f-33 w-37px" />
                <p class="f-16 f-light mt-2">{{ object.amount }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>

const props = defineProps({
    data: {
        type: Object
    }
})

</script>

<style lang="scss" scoped>

</style>