import * as React from "react";
import { PropsWithChildren, useState } from "react";
import { Box, Button, Grid } from "@mui/material";

interface EditableFormProps extends PropsWithChildren {
  editable: boolean;
  handleSubmit: any;
  titleElement: any;
}

export default function EditableForm({ editable, children, handleSubmit, titleElement }: EditableFormProps) {
  const [editableState, setEditableState] = useState<boolean>(editable);

  const onClickCallback = () => {
    setEditableState((prevState) => !prevState);
  };

  const editButtonMessage = editableState ? "Cancel" : "Edit";

  const submitButton = editableState ? (
    <Button type="submit" variant="outlined">
      Submit
    </Button>
  ) : null;

  return (
    <Box component="div">
      <form onSubmit={handleSubmit}>
        <Grid container justifyContent="space-between" alignItems="flex-start" sx={{ marginBottom: 2 }}>
          <Grid item>{titleElement}</Grid>
          <Grid item>
            <Button onClick={onClickCallback} variant="outlined">
              {editButtonMessage}
            </Button>
          </Grid>
        </Grid>
        <fieldset disabled={!editableState} style={{ border: "none" }}>
          <Grid container direction="column" spacing={3}>
            <Grid item>{children}</Grid>
            <Grid item>{submitButton}</Grid>
          </Grid>
        </fieldset>
      </form>
    </Box>
  );
}
