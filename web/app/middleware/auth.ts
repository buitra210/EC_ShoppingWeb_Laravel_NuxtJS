import { useAuthStore } from "~/store/auth";
export default defineNuxtRouteMiddleware(async (to, from) => {
  if (!(await isAuthenticated())) {
    return navigateTo("/auth/signin");
  }
});
const isAuthenticated = async () => {
  const auth = useAuthStore();
  try {
    await auth.get();
    return true;
  } catch (error) {
    return false;
  }
};
