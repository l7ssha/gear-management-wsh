import * as React from "react";
import { PropsWithChildren } from "react";

interface EditableFormProps extends PropsWithChildren {
  editable: boolean;
  handleSubmit: any;
}

export default function EditableForm({ editable, children, handleSubmit }: EditableFormProps) {
  return (
    <form onSubmit={handleSubmit}>
      <fieldset disabled={!editable}>{children}</fieldset>
    </form>
  );
}
