<script setup>
const props = defineProps({
  links: Object,
});
</script>

<template>
  <div class="max-w-screen-lg mx-auto mt-8">
    <UBreadcrumb
      :links="links"
      :ui="{
        wrapper: 'mx-4',
        li: 'text-primary dark:text-primary',
        active: 'text-primary dark:text-primary-400',
        inactive: 'hover:text-gray-700 dark:hover:text-gray-200',
      }"
    />
  </div>
  <div class="max-w-3xl mx-auto">
    <div class="rounded-xl px-6 py-6 my-10 mx-4 bg-base-200">
      <div class="py-6 px-6">
        <slot name="content" />
      </div>
    </div>
  </div>
</template>
