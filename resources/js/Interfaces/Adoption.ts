import { Animal } from "./Animal";
import { User } from "./User";

export interface Adoption {
    id: number;
    notes: string;
    approved: boolean;
    animal_id: number;
    user_id: number;
    approved_by_id: number | null;
    animal?: Animal;
    user?: User;
    approver?: User | null;
    created_at?: string | null;
    updated_at?: string | null;
}
