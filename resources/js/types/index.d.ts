import type { User } from "@/Interfaces/User";

declare module "@inertiajs/core" {
    interface PageProps {
        auth: {
            user: User | null;
        };
    }
}
