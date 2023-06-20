<template>
    <div class="blue-item rounded-pill wh-36 d-middle-center">
        <el-dropdown class="dropdown-options">
            <i class="icon-dots-vertical f-24"></i>
            <template #dropdown>
                <el-dropdown-menu class="p-2 w-176px">
                    <slot></slot>
                </el-dropdown-menu>
            </template>
        </el-dropdown>
    </div>
</template>

<script setup>


</script>

<style scoped>

</style>