<script setup>
definePageMeta({
  middleware: "auth",
});
const { user } = useAuth();
const { $apiFetch } = useNuxtApp();
const fetchFavorites = async () => {
  try {
    await $apiFetch(`/api/mypage/${user.id}`, {
      method: "GET",
    });
  } catch (e) {
    console.log(e.response);
  }
};
onMounted(fetchFavorites);
</script>

<template></template>
