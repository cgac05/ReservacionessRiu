create or alter proc sp_obtnerCliente 
    @idReserva          int,
    @nombreCliente      nvarchar (100) output,
    @emailCliente       nvarchar (100) output
as begin
    select @nombreCliente = concat(c.nombre,' ',c.Apellido), @emailCliente = c.Email from clientes c
    inner join reservaciones r on r.ClienteId = c.ClienteId
    where r.ReservacionId = @idReserva;
    return;
end