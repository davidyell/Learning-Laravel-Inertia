import { Animal } from "./Animal";

export interface Species {
    id: number;
    name: string;
    created_at: string | null;
    updated_at: string | null;
    animals?: Animal[];
}
