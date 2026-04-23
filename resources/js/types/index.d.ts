import type { User } from "@/interfaces/User";

declare module "@inertiajs/core" {
    interface PageProps {
        auth: {
            user: User | null;
        };
    }
}
