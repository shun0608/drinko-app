<template>
  <div>
    <div v-for="user in users" :key="user">{{ user.name }}</div>
    <div>
      <button @click="post">ポスト</button>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  middleware: "auth",
});

const { $apiFetch } = useNuxtApp();
const users = ref();
const { user, loggedIn } = useAuth(); // or useState('auth').value

const post = async () => {
  const response = await $apiFetch(`api/posts`, { method: "POST" });
  users.value = response.users;
};
</script>

<style></style>
