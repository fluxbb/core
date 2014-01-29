@extends('fluxbb::admin.layout.main')

@section('main')

    <!-- begin main div -->
    <div class="main">

        <!-- begin container -->
        <div class="container">

                <h3>Notes</h3>

                <div class="row">

                    <div class="col-md-8">

                        <h4><i class="icon-pencil"></i> New note</h4>
                        <div class="dashbox">
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Use the note to inform your fellow admins of current issues at hands.
                            </div>
                            <div class="form-group">
                                <label for="exampleInput" class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="exampleInput" type="text" placeholder="My title" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea" class="col-lg-2 control-label">Message</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="exampleTextarea" placeholder="My note"></textarea>
                                </div>
                            </div>
                            <p class="text-right"><input type="submit" class="btn btn-success" value="Save" /></p>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <h4><i class="icon-save"></i> Drafts</h4>
                        <div class="dashbox">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>By</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="#">Julius Caesar</a></td>
                                        <td>Gallia est omnis divisa in partes tres…</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="#">Julius Caesar</a></td>
                                        <td>Gallia est omnis divisa in partes tres…</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><a href="#">Julius Caesar</a></td>
                                        <td>Gallia est omnis divisa in partes tres…</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><a href="#">Julius Caesar</a></td>
                                        <td>Gallia est omnis divisa in partes tres…</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                <div class="dashbox">

                    <h4>5 last notes</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#">Julius Caesar</a></td>
                                <td>2013-06-01</td>
                                <td>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae, aliam Aquitani, tertiam qui ipsorum lingua Celtae, nostra Galli appellantur. Hi omnes lingua, institutis, legibus inter se differunt. Gallos ab Aquitanis Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="#">Julius Caesar</a></td>
                                <td>2013-06-01</td>
                                <td>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae, aliam Aquitani, tertiam qui ipsorum lingua Celtae, nostra Galli appellantur. Hi omnes lingua, institutis, legibus inter se differunt. Gallos ab Aquitanis Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="#">Julius Caesar</a></td>
                                <td>2013-06-01</td>
                                <td>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae, aliam Aquitani, tertiam qui ipsorum lingua Celtae, nostra Galli appellantur. Hi omnes lingua, institutis, legibus inter se differunt. Gallos ab Aquitanis Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="#">Julius Caesar</a></td>
                                <td>2013-06-01</td>
                                <td>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae, aliam Aquitani, tertiam qui ipsorum lingua Celtae, nostra Galli appellantur. Hi omnes lingua, institutis, legibus inter se differunt. Gallos ab Aquitanis Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="#">Julius Caesar</a></td>
                                <td>2013-06-01</td>
                                <td>Gallia est omnis divisa in partes tres, quarum unam incolunt Belgae, aliam Aquitani, tertiam qui ipsorum lingua Celtae, nostra Galli appellantur. Hi omnes lingua, institutis, legibus inter se differunt. Gallos ab Aquitanis Garumna flumen, a Belgis Matrona et Sequana dividit. Horum omnium fortissimi sunt Belgae</td>
                            </tr>
                        </tbody>
                    </table>
            
                </div>

            </div> 
            <!-- end container -->

        </div>
        <!-- end main div -->

@stop